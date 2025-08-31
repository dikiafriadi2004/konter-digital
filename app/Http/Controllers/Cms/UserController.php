<?php

namespace App\Http\Controllers\Cms;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);
        return view('cms.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('cms.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $role = Role::find($data['role']);
        $user->assignRole($role);

        return redirect()->route('users.index')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('cms.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $role = Role::find($request->role);
        if ($role) {
            $user->syncRoles([$role->name]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', "Can't delete own account ❌");
        }

        $user->delete();
        return back()->with('success', 'User soft deleted.');
    }

    public function trash()
    {
        $users = User::onlyTrashed()->with('roles')->latest()->paginate(10);
        return view('cms.users.trash', compact('users'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.trash')->with('success', 'User restored successfully.');
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', "Can't delete own account permanently ❌");
        }

        // Force delete semua post milik user
        foreach ($user->posts()->withTrashed()->get() as $post) {
            if ($post->thumbnail) {
                $fullPath = storage_path('app/public/' . $post->thumbnail);
                if (file_exists($fullPath)) {
                    @unlink($fullPath);
                    Log::info("Thumbnail {$post->thumbnail} milik Post {$post->id} berhasil dihapus.");
                } else {
                    Log::warning("Thumbnail {$post->thumbnail} milik Post {$post->id} TIDAK DITEMUKAN di disk!");
                }
            }

            $post->forceDelete();
            Log::info("Post {$post->id} milik User {$user->id} dihapus permanen.");
        }

        $user->forceDelete();
        Log::info("User {$user->id} dihapus permanen.");

        return redirect()->route('users.trash')
            ->with('success', 'User permanently deleted!');
    }
}
