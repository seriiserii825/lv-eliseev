<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->orderByDesc('id')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'status' => User::STATUS_ACTIVE,
            'password' => Hash::make($request['password']),
            'verify_token' => Str::random(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User was created');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $statuses = [User::STATUS_WAIT, User::STATUS_ACTIVE];
        return view('admin.users.edit', compact('user', 'statuses'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,id,' . $user->id,
            'status' => ['required', 'string', Rule::in(User::STATUS_WAIT, User::STATUS_ACTIVE)],
        ]);

        $user->update($request->only(['name', 'email', 'status']));

        return redirect()->route('admin.users.index')->with('success', 'User was updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User was deleted');
    }
}
