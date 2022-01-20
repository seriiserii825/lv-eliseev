<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }


    public function index(Request $request)
    {
        $users = $this->userRepository->getByFilter($request);
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
        try {
            User::register($request['name'], $request['email'], $request['password']);
            return redirect()->route('admin.users.index')->with('success', 'User was created');
        } catch (QueryException $e) {
            return back()->withErrors(['msg' => $e->getMessage()]);
        }
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
        try {
            $user->update($request->only(['name', 'email', 'status', 'role']));
            return redirect()->route('admin.users.index')->with('success', 'User was updated');
        } catch (QueryException $e) {
            return back()->withErrors(['msg' => $e->getMessage()]);
        }
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
