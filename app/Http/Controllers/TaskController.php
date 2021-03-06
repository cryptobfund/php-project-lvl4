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
        $data = $request->validate([
            'name' => 'required|unique:tasks',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable',
        ]);

        //create new record
        $task = new Task();
        $task->fill($data);
        $user = Auth::user();
        $task->creator()->associate($user);
        $task->save();

        $labels = $request->input('labels');
        if (!empty($labels[0])) {
            $task->labels()->sync($labels);
        }
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
        $data = $request->validate([
            'name' => 'required|unique:tasks,name,' . $task->id,
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable',
        ]);

        //update record
        $task->fill($data)->save();
        $task->labels()->detach();
        $labels = $request->input('labels');
        if (!empty($labels[0])) {
            $task->labels()->sync($labels);
        }

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
        $this->authorize('delete', $task);
        $task->labels()->detach();
        $task->delete();
        flash(__('task_massages.removed'))->success();
        return redirect()->route('tasks.index');
    }
}
