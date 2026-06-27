<?php

namespace App\Http\Controllers;

use App\Models\{
    Role, 
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);

        $query = User::query();

        // Apply search constraints if present
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('middle_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Fetch results with current row limits
        $users = $query->paginate($perPage);

        // Get roles for 
        $roles = Role::get();

        // Return variables so Blade can retain form states
        return view('pages.users.index', compact('users', 'roles', 'search', 'perPage'));
    }

    public function store(Request $request)
    {
        // 1. Enforce strict validation constraints matching the registration inputs
        $request->validate([
            'first_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name'   => 'required|string|max:255',
            'username'    => 'required|string|max:255|unique:users,username',
            'email'       => 'required|string|email|max:255|unique:users,email',
            'role_id'     => 'required|integer|exists:roles,id', // Validates that the role actually exists
            'password'    => 'required|string|min:8|confirmed',  // Matches against password_confirmation
        ]);

        // 2. Persist the database record with an encrypted password string
        User::create([
            'first_name'  => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name'   => $request->last_name,
            'username'    => $request->username,
            'email'       => $request->email,
            'role_id'     => $request->role_id,
            'password'    => Hash::make($request->password), // Safely cryptographically hash password
        ]);

        return back()->with('success', "Account for {$request->first_name} has been successfully registered!");
    }

    /**
     * Update an existing user's profile in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. Fetch user or trigger an automatic 404 response
        $user = User::findOrFail($id);

        // 2. Validate changing information (making sure unique checks ignore the current user's ID)
        $request->validate([
            'first_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name'   => 'required|string|max:255',
            'username'    => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'       => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id'     => 'required|integer|exists:roles,id',
            'password'    => 'nullable|string|min:8|confirmed', // Optional! Only updates if they type a new one
        ]);

        // 3. Prepare dataset array for clean mass updates
        $updateData = [
            'first_name'  => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name'   => $request->last_name,
            'username'    => $request->username,
            'email'       => $request->email,
            'role_id'     => $request->role_id,
        ];

        // 4. Conditional Check: Only apply password change if the field was populated
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        // 5. Commit properties straight to the database
        $user->update($updateData);

        return back()->with('success', "Profile updates for {$user->username} applied cleanly!");
    }
}