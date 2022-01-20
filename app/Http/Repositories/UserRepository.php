<?php

namespace App\Http\Repositories;

use App\User;

class UserRepository
{

    public function getAll()
    {
        return User::query()
            ->select(User::FILLABLE_COLUMNS)
            ->get();
    }

    public function getOne($id)
    {
        return User::query()
            ->select(User::FILLABLE_COLUMNS)
            ->find($id);
    }

    public function getByFilter($request)
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
        return $query->paginate(40);
    }

}
