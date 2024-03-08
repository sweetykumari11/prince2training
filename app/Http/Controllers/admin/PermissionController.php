<?php

namespace App\Http\Controllers\admin;

use App\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Yajra\DataTables\Facades\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $modules = Module::where('is_active', 1)->get();

        if ($request->ajax()) {
            $query = Permission::query();
            if (!empty($request->module_id)) {
                $query->where('module_id', $request->module_id);
            }
            if (!empty($request->access)) {
                $query->whereRaw("SUBSTRING_INDEX(name, '-', -1) = ?", [$request->access]);
            }
            return Datatables::of($query)
                ->addColumn('module_name', function ($permission) {
                    return $permission->module->name;
                })
                ->make(true);
        }

        return view('admin.permission.index', compact('modules'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $modules= Module::all();
        return view('admin.permission.create',compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $is_active = $request->is_active == "on" ? 1 : 0;
        $module = Module::find($request->module_id);
        $name = strtolower($module->name) . "-" . $request->access;

        $haspermission = Permission::query()
            ->where('name', $name)
            ->where('module_id', $request->input('module_id'))
            ->exists();

        if ($haspermission) {
            return back()->withErrors([
                'access' => 'Access already exits.'
            ]);
        }

        Permission::create([
            'module_id' => $request->module_id,
            'name' => $name,
            'guard_name' => 'web',
            'description' => $request->description,
            'is_active' => $is_active,
        ]);

        return redirect()->route('permission.index')
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $modules = Module::where('is_active', 1)->get();
        return view('admin.permission.edit', compact('permission', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {

        $is_active = $request->has('is_active') ? 1 : 0;
        $module = Module::find($request->module_id);
        $name = strtolower($module->name) . "-" . $request->access;

        $haspermission = Permission::query()
            ->where('name', $name)
            ->where('module_id', $request->input('module_id'))
            ->where('id', '!=', $permission->id)
            ->exists();

        if ($haspermission) {
            return back()->withErrors([
                'access' => 'Access already exits.'
            ]);
        }

        $permission->update([
            'module_id' => $request->module_id,
            'name' => strtolower($module->name) . "-" . $request->access,
            'guard_name' => 'web',
            'description' => $request->description,
            'is_active' => $is_active,

        ]);
        return redirect()->route('permission.index')
            ->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        session()->flash('danger', 'Permission Deleted successfully.');
        return redirect()->route('permission.index');
    }
}
