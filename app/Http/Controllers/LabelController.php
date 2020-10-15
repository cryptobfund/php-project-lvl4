<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $labels = Label::all();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $label = new Label();
        return view('label.create', compact('label'));
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
            'name' => 'required|unique:labels',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            collect($validator->errors()->all())
                ->each(function ($message) {
                    flash($message)->error();
                });

            return redirect()->route('labels.create');
        }

        //create new record
        $data = $request->input();
        $label = new Label();
        $label->fill($data);
        $label->save();

        flash(__('label_massages.added'))->success();
        return redirect()->route('labels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Label $label)
    {
        //Validation
        $validator = Validator::make($request->all(), [
            'name' => "required|unique:labels,name," . $label->id,
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            collect($validator->errors()->all())
                ->each(function ($message) {
                    flash($message)->error();
                });
            return redirect()->route('labels.edit', compact('label'));
        }

        //update record
        $data = $request->input();
        $label
            ->fill($data)
            ->save();
        flash(__('label_massages.updated'))->success();
        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Label $label)
    {
        if ($label) {
            $tasks = $label->tasks()->count();
            if (empty($tasks)) {
                $label->delete();
                flash(__('task_status_massages.removed'))->success();
                return redirect()->route('labels.index');
            }
        }
        flash(__('task_status_massages.removed_deny'))->error();
        return redirect()->route('labels.index');
    }
}
