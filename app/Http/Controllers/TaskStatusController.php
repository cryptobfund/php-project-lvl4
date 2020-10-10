<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('task_status.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('task_status.create', compact('taskStatus'));
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
        $validator = Validator::make($request->all(), ['name' => 'required|unique:task_statuses']);
        if ($validator->fails()) {
            flash($validator->errors()->first('name'))->error();
            return redirect()->route('task_statuses.create');
        }

        //create new record
        $data = $request->input('name');
        $taskStatus = new TaskStatus();
        $taskStatus->fill(['name' => $data])->save();

        flash(__('task_status_massages.added'))->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function show(TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('task_status.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        //Validation
        $validator = Validator::make($request->all(), ['name' => 'required|unique:task_statuses']);
        if ($validator->fails()) {
            flash($validator->errors()->first('name'))->error();
            return redirect()->route('task_statuses.edit', $taskStatus);
        }

        //update record
        $data = $request->input('name');
        $taskStatus->fill(['name' => $data])->save();

        flash(__('task_status_massages.updated'))->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus) {
            $tasks = $taskStatus->tasks()->count();
            if (empty($tasks)) {
                $taskStatus->delete();
                flash(__('task_status_massages.removed'))->success();
                return redirect()->route('task_statuses.index');
            }
        }
        flash(__('task_status_massages.removed_deny'))->error();
        return redirect()->route('task_statuses.index');
    }
}
