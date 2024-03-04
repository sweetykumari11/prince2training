<?php

namespace App\Http\Controllers;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Carbon\Carbon;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = User::with('creator', 'roles');
            return Datatables::eloquent($query)->make(true);
        }
        return view('user.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'created_by' => 1
        ]);
        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('danger', 'User deleted successfully');
    }
    public function Reset(Request $request)
    {
        $data = User::find($request->id);
        Mail::to($data->email, $data->name)->send(new ResetPassword($data));
        return redirect()->route('user.index')
        ->with('success', 'Password sent successfully to your mail');
    }
    public function showResetForm(Request $request)
    {
        $id = $request->id;
        return view('password.resetpassword', compact('id'));
    }
    public function changepassword(PasswordRequest $request)
    {

        $user = User::find($request->id);
        $token = Str::random(60);
        $currentDateTime = Carbon::now();
        $user->update(['reset_token' => $token,'password'=>$request->confirmPassword,'password_changed_at'=>$currentDateTime]);
        return redirect()->back()->with('success', 'Password changed successfully!');
    }
}
