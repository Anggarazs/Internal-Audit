<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $laporan_audit = DB::table('laporan_audit')->count();
        $event_audit = DB::table('corrective_action')->count();
        return view('dashboard.index',compact('laporan_audit','event_audit'));
    }
}
