<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = Admin::with('roles')->latest()->get();
        return view('admin.management.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.management.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|exists:roles,name',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'status' => $request->status ?? 1,
        ]);

        $admin->assignRole($request->role);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin user created successfully!');
    }

    public function edit(Admin $admin)
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.management.admins.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|exists:roles,name',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status ?? 1,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);
        $admin->syncRoles([$request->role]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin user updated successfully!');
    }

    public function destroy(Admin $admin)
    {
        // Prevent deleting yourself
        if ($admin->id === auth('admin')->id()) {
            return redirect()->route('admin.admins.index')
                ->with('error', 'You cannot delete your own account!');
        }

        // Prevent deleting super admin if you're not super admin
        if ($admin->hasRole('SuperAdmin') && !auth('admin')->user()->hasRole('SuperAdmin')) {
            return redirect()->route('admin.admins.index')
                ->with('error', 'You cannot delete Super Admin!');
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin user deleted successfully!');
    }

    public function toggleStatus(Admin $admin)
    {
        $admin->update(['status' => !$admin->status]);
        
        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin status updated successfully!');
    }
}
