<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    private function getViewParams($task = null)
    {
        $modelsForSelect = function ($className) {
            $models = $className::all();
            return $models->mapWithKeys(function ($model) {
                return [$model->id => $model->name];
            });
        };

        $labelsForSelectSelected = null;
        if ($task) {
            $labels = Label::all();
            $labelsForSelectSelected = collect($labels->modelKeys())
                ->filter(function ($item) use ($task) {
                    return $task->labels()->get()->contains($item);
                });
        }

        return [
            'taskStatusesForSelect' => $modelsForSelect(TaskStatus::class),
            'usersForSelect' => $modelsForSelect(User::class),
            'labelsForSelect' => $modelsForSelect(Label::class),
            'labelsForSelectSelected' => $labelsForSelectSelected
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->get();

        $params = $this->getViewParams();
        return view('task.index', compact('tasks', 'params', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $task = new Task();
        $params = $this->getViewParams();

        return view('task.create', compact('task', 'params'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tasks',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable'
        ]);
        if ($validator->fails()) {
            collect($validator->errors()->all())
                ->each(function ($message) {
                    flash($message)->error();
                });

            return redirect()->route('tasks.create');
        }

        //create new record
        $data = $request->input();
        $task = new Task();
        $task->fill($data);
        $user = Auth::user();
        $task->creator()->associate($user);
        $task->save();
        collect($data['labels'])->each(function ($label) use ($task) {
            $task->labels()->attach($label);
        });
        flash(__('task_massages.added'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Task $task)
    {
        $params = $this->getViewParams();
        return view('task.show', compact('task', 'params'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Task $task)
    {
        $params = $this->getViewParams($task);
        return view('task.edit', compact('task', 'params'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        //Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable'
        ]);
        if ($validator->fails()) {
            collect($validator->errors()->all())
                ->each(function ($message) {
                    flash($message)->error();
                });

            return redirect()->route('tasks.edit', compact('task'));
        }

        //update record
        $data = $request->input();
        $task->fill($data)->save();

        $task->labels()->detach();
        collect($data['labels'])->each(function ($label) use ($task) {
            $task->labels()->attach($label);
        });

        flash(__('task_massages.updated'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $user = Auth::user();
        if ($user->can('delete', $task)) {
            if ($task) {
                $task->labels()->detach();
                $task->delete();
                flash(__('task_massages.removed'))->success();
            }
            return redirect()->route('tasks.index');
        }
        flash(__('task_massages.removed_deny'))->error();
        return redirect()->route('tasks.index');
    }
}
