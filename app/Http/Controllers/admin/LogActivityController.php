<?php

namespace App\Http\Controllers\admin;

use App\Models\LogActivity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use App\Http\Controllers\Controller;

class LogActivityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = LogActivity::with('creator');
            return Datatables::eloquent($query)->make(true);
        }
        return view('admin.logactivities.list');
    }
}
