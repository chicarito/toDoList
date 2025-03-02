<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\password;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->latest()->get();
        return view('admin.index', compact('users'));
    }

    public function store(Request $request)
    {
        $user = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user['password'] = bcrypt($request->password);

        User::create($user);

        return back()->with('status', 'berhasil tambah pengguna');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::find($id);

        $upd = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'password' => 'nullable',
            'role' => 'required',
        ]);

        if ($request->password) {
            $upd['password'] = bcrypt($request->password);
        } else {
            unset($upd['password']);
        }

        $user->update($upd);

        return redirect('/admin')->with('status', 'berhasil update pengguna');
    }

    public function delete($id)
    {
        $user = User::find($id);

        $user->delete();

        return back()->with('status', 'berhasil hapus pengguna');
    }
}
