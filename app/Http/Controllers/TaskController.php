<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    private function getIndexViewParams()
    {
        return [
            'taskStatuses' => TaskStatus::all(),
            'users' => User::all()
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $tasks = Task::all();
        $params = $this->getIndexViewParams();
        return view('task.index', compact('tasks', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        $params = $this->getIndexViewParams();
        return view('task.create', compact('task', 'params'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable'
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                flash($message)->error();
            }
            return redirect()->route('tasks.create');
        }

        //create new record
        $data = $request->input();
        $task = new Task();
        $task->fill($data);
        $user = Auth::user();
        $task->created_by_id = $user->id;
        $task->save();

        flash(__('task_massages.added'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $params = $this->getIndexViewParams();
        return view('task.show', compact('task', 'params'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $params = $this->getIndexViewParams();
        return view('task.edit', compact('task', 'params'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
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
            foreach ($validator->errors()->all() as $message) {
                flash($message)->error();
            }
            return redirect()->route('tasks.edit', compact('task'));
        }

        //update record
        $data = $request->input();
        $task
            ->fill($data)
            ->save();
        flash(__('task_massages.updated'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $user = Auth::user();
        if ($user->can('delete', $task)) {
            if ($task) {
                $task->delete();
                flash(__('task_massages.removed'))->success();
            }
            return redirect()->route('tasks.index');
        }
        flash(__('task_massages.removed_deny'))->error();
        return redirect()->route('tasks.index');
    }
}
