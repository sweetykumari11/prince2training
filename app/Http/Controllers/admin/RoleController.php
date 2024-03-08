<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Module;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Yajra\DataTables\Facades\Datatables;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalUserCount = Role::all()->flatMap->users->count(); // Calculate total user count across all roles

        if ($request->ajax()) {
            $query = Role::query();

            return Datatables::eloquent($query)
                ->addColumn('user_counts', function ($role) {
                    $userCounts = $role->users->count();

                    // Format user counts as a string for display
                    return $userCounts;
                })
                ->make(true);
        }
        // if ($request->ajax()) {
        //     $query = Role::query();
        //     return Datatables::eloquent($query)->make(true);
        // }
        return view('role.index');
    }

    // if ($request->ajax()) {
    //     // $query = Role::query();
    //     // $roleCounts = $query->groupBy('name')->map->count();
    //     // return Datatables::eloquent($query)->make(true);
    //     $query = Role::query();
    //     $roles = $query->get(); // Fetch all roles

    //     // Group roles by name and count each group
    //     $roleCounts = $roles->groupBy('name')->map->count();

    //     return Datatables::eloquent($query)
    //         ->addColumn('role_count', function($role) use ($roleCounts) {
    //             return $roleCounts[$role->name] ?? 0;
    //         })
    //         ->toJson();
    // }

    // $roles = Role::all();
    //$roleCounts = $roles->groupBy('name')->map->count();

    // return view('role.index');

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $is_active = $request->is_active == "on" ? 1 : 0;
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'guard_name' => 'web',
            'is_active' => $is_active,
        ]);
        if ($request->permissions) {
            $selectedPermissions = $request->input('permissions', []);
            $role->syncPermissions($selectedPermissions);
        }
        return redirect()->route('role.index')->with('success', 'Role created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $modulesWithPermissions = Module::where('is_active', 1)->with('permissions')->get();
        return view('role.edit', compact('role', 'modulesWithPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $is_active = $request->is_active == "on" ? 1 : 0;


        $is_active = $request->is_active == "on" ? 1 : 0;
        $role->update(['name' => $request->name, 'description' => $request->description, 'is_active' => $is_active]);

        if ($request->permissions) {
            $selectedPermissions = $request->input('permissions', []);
            $role->syncPermissions($selectedPermissions);
        }
        return redirect()->route('role.index')->with('success', 'Role updated successfully');
        $is_active = $request->is_active == "on" ? 1 : 0;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        //$role->permissions()->detach();
        session()->flash('danger', 'Role Deleted successfully.');
        return redirect()->route('role.index');
    }
}
