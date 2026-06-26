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

    /**
     * Store a newly created administrator.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $checkUser = User::where('email', $request->email)->first();
        if ($checkUser) {
            return redirect()->route('users.index', ['tab' => 'admins'])
                ->with('error', 'Email already exists. Please use a different email address.')
                ->withInput();
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index', ['tab' => 'admins'])
            ->with('success', 'System Administrator created successfully!');
    }
}