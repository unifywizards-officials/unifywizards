<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view users')->only(['index', 'show', 'trashed']);
        $this->middleware('permission:create users')->only(['create', 'store']);
        $this->middleware('permission:edit users')->only(['edit', 'update']);
        $this->middleware('permission:delete users')->only(['destroy', 'restore']);
    }

    /**
     * Display all users
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('created_at', 'desc')->get();
        $roles = Role::all();
      

        return view('admin.pages.users.index', compact('users', 'roles'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store new user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show single user
     */
    public function show(User $user)
    {
        return view('admin.pages.users.show', compact('user'));
    }

    /**
     * Show edit form
     */
    public function edit(User $user)
    {
        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Show trashed users
     */
    public function trashed()
    {
        $users = User::onlyTrashed()->get();

        return view('admin.pages.users.trashed', compact('users'));
    }

    /**
     * Restore deleted user
     */
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $user->restore();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User restored successfully.');
    }
}