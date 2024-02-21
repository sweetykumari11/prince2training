<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Module::query();
            return Datatables::eloquent($query)->make(true);
        }
        return view('module.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModuleRequest $request)
    {
        $is_active = $request->is_active == "on" ? 1 : 0;
        Module::create([
            'name' => $request->name,
            'is_active' => $is_active
        ]);
        session()->flash('success', 'Module Created successfully.');
        return redirect()->route('module.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        return view('module.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModuleRequest $request, Module $module)
    {
        $is_active = $request->is_active == "on" ? 1 : 0;
        $module->update([
            'name' => $request->name,
            'is_active' => $is_active
        ]);
        session()->flash('success', 'Module updated successfully.');
        return redirect()->route('module.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();
        session()->flash('danger', 'Module Deleted successfully.');
        return redirect()->route('module.index');
    }
}
