<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    public function index()
    {
        $data['users'] = User::orderBy('id', 'desc')->get();
        return view('administrator.view', $data);
    }



    public function insert(Request $request)
    {
        if ($request->password === $request->confirm_password) {
            if (!empty($_POST['avatar'])) {
                $filename = date('dmyHis') . '.jpg';
                // upload image
                $path = $request->file('avatar')->storeAs('public/avatars', $filename);
            } else {
                $filename = 'default.jpg';
            }

            $user = User::create([
                'username' => $request->username,
                'display_name' => $request->display_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'avatar' => $filename,
            ]);
            if ($user) {
                return redirect()->back()->with('success', 'Berhasil menambah user');
            }
        } else {
            return redirect()->back()->with('error', 'Gagal menambah user');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('administrator.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);
        // jika password diisi
        if ($request->password != null) {
            if ($request->password === $request->confirm_password) {
                $user->password = Hash::make($request->password);
            } else {
                return redirect()->route('users')->with('message-error', 'Gagal merubah user');
            }
        }
        if ($request->hasFile('avatar')) {
            $filename = date('dmyHis') . '.jpg';
            // upload image
            $path = $request->file('avatar')->storeAs('public/avatars', $filename);
        } else {
            $filename = $user->avatar;
        }

        $user->username =  $request->username;
        $user->display_name =  $request->display_name;
        $user->email =  $request->email;
        $user->role =  $request->role;
        $user->avatar =  $filename;
        if ($user->save()) {
            return redirect()->route('users')->with('success', 'Berhasil merubah user');
        }
    }

    public function delete($id)
    {
        if (User::where('id', $id)->delete()) {
            return redirect()->back()->with('success', 'Berhasil menghapus user');
        }
    }
}
