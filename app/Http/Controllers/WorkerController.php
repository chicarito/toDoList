<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    public function index()
    {
        $task = Task::with('taskDetail')->where('created_by', Auth::user()->id)->whereHas('creator', function ($query) {
            $query->where('role', 'worker');
        })->latest()->take(3)->get();

        foreach ($task as $count_taskDetail) {
            $total_taskDetail = $count_taskDetail->taskDetail->count();
            $completed_taskDetail = $count_taskDetail->taskDetail->where('status', true)->count();

            $count_taskDetail->progress = [
                'total' => $total_taskDetail,
                'completed' => $completed_taskDetail,
            ];
        }
        return view('worker.index', compact('task'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $task = $request->validate([
            'title' => 'required',
            'desc' => 'nullable',
            'deadline' => 'nullable',
            'created_by' => 'required',
            'assigned_to' => 'required',
        ]);

        Task::create($task);

        return back();
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return view('worker.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $upd = $request->validate([
            'title' => 'required',
            'desc' => 'nullable',
            'deadline' => 'nullable',
            'created_by' => 'required',
            'assigned_to' => 'required'
        ]);

        $task->update($upd);
        return redirect('/worker');
    }

    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();
        return back();
    }

    public function add_detail_task($id)
    {
        $task = Task::find($id);
        $task_detail = TaskDetail::where('task_id', $id)->get();

        return view('worker.detail_task.index', compact('task', 'task_detail'));
    }

    public function store_detail_task(Request $request)
    {
        // dd($request->all());
        $task_detail = $request->validate([
            'title' => 'required',
            'desc' => 'nullable',
            'task_id' => 'nullable',
        ]);

        TaskDetail::create($task_detail);
        return back();
    }

    public function edit_detail_task($id)
    {
        $task_detail = TaskDetail::find($id);
        return view('worker.detail_task.update', compact('task_detail'));
    }


    public function update_detail_task(Request $request, $id)
    {
        $task_detail = TaskDetail::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'desc' => 'nullable',
            'status' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:10240',
        ]);

        if ($request->hasFile('image')) {
            if ($task_detail->image) {
                @unlink(public_path('images/' . $task_detail->image));
            }

            $data['image'] = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $data['image']);
        }

        $task_detail->update($data);

        return redirect('add-task-detail/' .  $task_detail->task->id);
    }

    public function all_task()
    {
        $task = Task::with('taskDetail')->where('created_by', Auth::user()->id)->where('assigned_to', Auth::user()->id)->latest()->get();

        foreach ($task as $count_taskDetail) {
            $total_taskDetail = $count_taskDetail->taskDetail->count();
            $completed_taskDetail = $count_taskDetail->taskDetail->where('status', true)->count();

            $count_taskDetail->progress = [
                'total' => $total_taskDetail,
                'completed' => $completed_taskDetail,
            ];
        }
        return view('worker.detail_task.all_task', compact('task'));
    }
}
