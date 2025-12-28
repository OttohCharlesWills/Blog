<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'blogger')->latest()->get();

        return view('admin.users.index', compact('users'));
    }

public function toggleStatus(User $user)
{
    $user->is_active = ! $user->is_active;
    $user->save();

    return back()->with('success', 'User status updated');
}


    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }
}