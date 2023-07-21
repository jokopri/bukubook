<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        abort_if(!Gate::allows('list-user'), 403, 'You are not allowed to access this page');

        return view('user.index', [
            'users' => User::paginate(5)
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required'],
            'email'     => ['required', 'email', 'unique:users'],
            'password'  => ['required', 'min:8', 'confirmed'],
            'roles'      => ['required'],
        ]);
        //dd($request->all());
        $name = $request->get('name');
        $email = $request->get('email');
        $roles = $request->get('roles');
        $password = $request->get('password');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->roles = $roles;
        $user->password = Hash::make($password);
        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        //dd($id);
        return view('user.edit', [
            'user' => User::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => ['required'],
            'email'     => ['required', 'email', 'unique:users,email,' .$id],
            'password'  => ['nullable','min:8', 'confirmed'],
            'roles'     => ['required']
        ]);

        $password = $request->get('password');

        //dd($request->all());
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->roles = $request->get('roles');

        if(!empty($password))
        {
            $user->password = Hash::make($password);
        }
        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'Data berhasil diedit!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'Data berhasil dihapus!');
    }

}
