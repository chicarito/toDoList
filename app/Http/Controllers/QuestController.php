<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskDetail;
use finfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestController extends Controller
{
    public function all_quest()
    {
        $quest = Task::with('taskDetail')->where('assigned_to', Auth::user()->id)->whereHas('creator', function ($query) {
            $query->where('role', 'tasker');
        })->latest()->get();

        foreach ($quest as $count_taskDetail) {
            $total_taskDetail = $count_taskDetail->taskDetail->count();
            $completed_taskDetail = $count_taskDetail->taskDetail->where('status', true)->count();

            $count_taskDetail->progress = [
                'total' => $total_taskDetail,
                'completed' => $completed_taskDetail,
            ];
        }

        return view('worker.quest.all_quest', compact('quest'));
    }

    public function detail_quest($id)
    {
        $quest = Task::find($id);
        $quest_detail = TaskDetail::where('task_id', $id)->get();

        return view('worker.quest.detail_quest', compact('quest', 'quest_detail'));
    }

    public function edit_quest($id)
    {
        $quest_detail = TaskDetail::find($id);
        return view('worker.quest.update_quest', compact('quest_detail'));
    }

    public function update_quest(Request $request, $id)
    {
        $quest_detail = TaskDetail::find($id);
        $upd = $request->validate([
            'status' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {
            if ($quest_detail->image) {
                @unlink(public_path('images/' . $quest_detail->image));
            }

            $upd['image'] = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $upd['image']);
        }

        $quest_detail->update($upd);

        return redirect('/quest/detail-quest/' . $quest_detail->task->id);
    }
}
