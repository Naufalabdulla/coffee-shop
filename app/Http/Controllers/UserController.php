<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * READ USER (INDEX)
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('user.index', compact('users'));
    }

    /**
     * FORM CREATE USER
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * STORE USER
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request['role']);

        return redirect()
            ->route('user.index')
            ->with('success', 'User successfully created!');
    }

    public function destroy(User $user)
    {

        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }


        if ($user->hasRole('admin')) {
            $adminCount = User::role('admin')->count();

            if ($adminCount <= 1) {
                return back()->with('error', 'Cannot delete the last admin.');
            }
        }


        $user->syncRoles([]);


        $user->delete();

        return redirect()
            ->route('user.index')
            ->with('success', 'User deleted successfully.');
    }
}
