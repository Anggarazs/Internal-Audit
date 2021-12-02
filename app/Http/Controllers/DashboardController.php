<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finding;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $laporan_audit = DB::table('laporan_audit')->count();
        $event_audit = DB::table('corrective_action')->count();
        $finding_open = 0;
        $finding_close = 0;
        $finding_count = 0;
        $finding_progress = 0;
        $finding = Finding::leftjoin('jumlah_temuan','jumlah_temuan.id_finding','finding.id_finding')
        ->leftjoin('root','root.id_jumlah_temuan','jumlah_temuan.id_jumlah_temuan')
        ->leftjoin('corrective_action','corrective_action.id_root','root.id_root')
        ->select('finding.*','jumlah_temuan.item_finding','root.root_cause','corrective_action.*')
        ->get();
        foreach ($finding as $key => $value) {
            $finding_count += 1;
            $finding_progress += $value->progress;
            if ($value->status == "Close") {
                $finding_close += 1;
            }
            else{
                $finding_open += 1;
            }
        }
        $total_progress = number_format($finding_progress/$finding_count,2);
        return view('dashboard.index',compact('laporan_audit','event_audit','total_progress','finding_close','finding_open'));
    }
}
