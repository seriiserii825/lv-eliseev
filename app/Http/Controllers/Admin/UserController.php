<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->orderByDesc('updated_at');
        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }
        if (!empty($value = $request->get('email'))) {
            $query->where('email', 'like', '%' . $value . '%');
        }
        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }
        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }
        if (!empty($value = $request->get('role'))) {
            $query->where('role', $value);
        }
        $users = $query->paginate(40);
        $statuses = User::statuses();
        $roles = User::roles();
        return view('admin.users.index', compact('users', 'statuses', 'roles'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateRequest $request)
    {

        User::register($request['name'], $request['email'], $request['password']);

        return redirect()->route('admin.users.index')->with('success', 'User was created');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $statuses = User::statuses();
        $roles = User::roles();
        return view('admin.users.edit', compact('user', 'statuses', 'roles'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->only(['name', 'email', 'status', 'role']));

        return redirect()->route('admin.users.index')->with('success', 'User was updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User was deleted');
    }

    public function verify(Request $request)
    {
        $user = User::query()->findOrFail($request['id']);
        try {
            $user->verify();
            return redirect()->route('admin.users.index')->with('success', 'User was verified');
        } catch (\DomainException $e) {
            return redirect()->route('admin.users.index')->with('error', $e->getMessage());
        }
    }
}
