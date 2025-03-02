<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailQuesController extends Controller
{
    public function add_detail_task($id)
    {
        $quest = Task::find($id);
        $task_detail = TaskDetail::where('task_id', $id)->get();
        return view('tasker.quest_detail.index', compact('quest', 'task_detail'));
    }

    public function store_detail_task(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'task_id' => 'required',
            'title' => 'required',
            'desc' => 'nullable',
        ]);

        TaskDetail::create($validate);
        return back()->with('status', 'berhasil tambah detail quest!');
    }

    public function edit_detail_task($id)
    {
        $task_detail = TaskDetail::find($id);
        return view('tasker.quest_detail.edit', compact('task_detail'));
    }

    public function update_detail_task(Request $request, $id)
    {
        // dd($request->all());
        $task_detail = TaskDetail::find($id);
        $upd = $request->validate([
            'title' => 'required',
            'desc' => 'required',
        ]);
        $task_detail->update($upd);
        return redirect('add-detail-quest/' .  $task_detail->task->id)->with('berhasil update detail quest!');
    }

    public function delete_detail_task($id)
    {
        $task_detail = TaskDetail::find($id);
        $task_detail->delete();
        return back()->with('status', 'berhasil hapus detail quest!');
    }

    public function show_detail_quest($id)
    {
        $quest_detail = TaskDetail::find($id);

        return view('tasker.quest_detail.show', compact('quest_detail'));
    }
}
