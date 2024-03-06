<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class LogActivityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = LogActivity::with('creator');
            return Datatables::eloquent($query)->make(true);
        }
        return view('logactivities.list');
    }
}
