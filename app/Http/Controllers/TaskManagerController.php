<?php

namespace App\Http\Controllers;

use App\taskManager;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fetch all data
        $tasks = taskManager::all()->sortBy("order");
        return view('tasks/index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show create form
        return view('tasks/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store the new task data
        // validate form
        $this->validate(request(), [
            'name' => 'required'
        ]);

        // get the data
        $data = request()->all();

        $task = new taskManager();
        $task->name = $data['name'];
        $task->completed = false;
        $task->order = taskManager::max('order') + 1;

        $task->save();

        session()->flash('message', 'Task Created Successfully!');

        return redirect('/tasks');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\taskManager $taskId
     * @return \Illuminate\Http\Response
     */
    public function edit(taskManager $taskId)
    {
        return view('tasks/edit')->with('task', $taskId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\taskManager $taskId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, taskManager $taskId)
    {
        // Update the data
        $this->validate(request(), [
            'name' => 'required',
        ]);

        $data = request()->all();

        $taskId->name = $data['name'];
        $taskId->updated_at = Carbon::now();
        $taskId->save();

        session()->flash('message', 'Task Updated Successfully!');

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\taskManager $taskManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(taskManager $taskId)
    {
        // delete the task
        $taskId->delete();

        session()->flash('message', 'Task Deleted Successfully!');

        return redirect('/tasks');
    }

    /**
     * Drag and drop sorting
     *
     * @param \App\taskManager $taskManager
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request)
    {
        $test = "";
        foreach ($request->get('order') as $id => $order) {
            taskManager::find($id)->update(['order' => $order]);
        }
    }
}
