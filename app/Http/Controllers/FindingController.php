<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\Department;
use App\Models\Finding;
use DB;

class FindingController extends Controller
{
    public function index_finding(){
        $finding = Finding::all();
        $Audit = Audit::all();
        return view('finding.finding_index',compact('finding','Audit'));
    }

    public function delete_finding($id){
        $finding =Finding::where("id_finding", $id);
        $finding->delete();
        session()->flash('berhasil', 'Corrective Action Berhasil Dihapus');
        return redirect('/finding');
    }
}
