<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->orderByDesc('id')->paginate(10);
        return view('admin.users.index', compact('users'));
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
        $statuses = [User::STATUS_WAIT, User::STATUS_ACTIVE];
        return view('admin.users.edit', compact('user', 'statuses'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->only(['name', 'email', 'status']));

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
