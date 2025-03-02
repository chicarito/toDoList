<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskerController extends Controller
{
    public function index()
    {
        $getUser = User::where('role', 'worker')->latest()->get();

        $quest = Task::with('taskDetail')->where('created_by', Auth::user()->id)->whereHas('creator', function ($query) {
            $query->where('role', 'tasker');
        })->latest()->take(3)->get();

        foreach ($quest as $count_taskDetail) {
            $total_taskDetail = $count_taskDetail->taskDetail->count();
            $completed_taskDetail = $count_taskDetail->taskDetail->where('status', true)->count();

            $count_taskDetail->progress = [
                'total' => $total_taskDetail,
                'completed' => $completed_taskDetail,
            ];
        }

        return view('tasker.index', compact('getUser', 'quest'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'title' => 'required',
            'desc' => 'nullable',
            'deadline' => 'nullable',
            'created_by' => 'required',
            'assigned_to' => 'required',
        ]);

        Task::create($validate);

        return back()->with('status', 'berhasil tambah quest!');
    }

    public function edit($id)
    {
        $quest = Task::find($id);
        $getUser = User::where('role', 'worker')->latest()->get();
        return view('tasker.edit', compact('quest', 'getUser'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $quest = Task::find($id);

        $validate = $request->validate([
            'title' => 'required',
            'desc' => 'nullable',
            'deadline' => 'nullable',
            'created_by' => 'required',
            'assigned_to' => 'required',
        ]);

        $quest->update($validate);
        return redirect('/tasker')->with('status', 'berhasil update quest!');
    }

    public function delete($id)
    {
        $quest = Task::find($id);
        $quest->delete();
        return back()->with('status', 'berhasil hapus quest');
    }

    public function all_quest()
    {
        $quest = Task::with('taskDetail')->where('created_by', Auth::user()->id)->whereHas('creator', function ($query) {
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
        return view('tasker.all_quest', compact('quest'));
    }
}
