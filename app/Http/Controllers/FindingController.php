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
        $Depart = Department::all();
        return view('finding.finding_index',compact('finding','Audit','Depart'));
    }

    public function data_tampil(Request $request){
        $laporan_audit = Audit::where('no_audit',$request->no_audit)->first();
        return response()->json([
            'data' => $laporan_audit
        ]);
    }

    public function insert_finding(Request $request){
        $validateData = $request->validate([
            "no_laporan_audit" => 'required|max:255',
            "judul_audit" => 'required|max:255',
            "status" => 'required|max:255',
            "tipe_audit" => 'required|max:255',
            "jenis_audit" => 'required|max:255',
            "risk_level" => 'required|max:255',
            "kriteria_audit" => 'required|max:255',
            "tahun_audit" => 'required',
            "tanggal_mulai_audit" => 'required|date_format:Y-m-d',
            "tanggal_akhir_audit" => 'required|date_format:Y-m-d',
            "auditor" => 'required|max:255',
            "finding" => 'required|max:255',
            "root" => 'required|max:255',
            "department" => 'required',
            "auditee" => 'required|max:255',
            "corrective" => 'required|max:255',
            "due_date" => 'required|date_format:Y-m-d'
        ]);
        // if($validateData->fails()) {
        //     return Redirect::back()->withErrors($validateData);
        // }
        $laporan_audit=Audit::where('no_audit',$request->get('no_laporan_audit'))->first();
        $department=Department::where('id',$request->get('department'))->first();
        $finding_data=new Finding;
        $finding_data->no_laporan_audit=$laporan_audit->no_laporan_audit;
        $finding_data->judul_audit=$request->get('judul_audit');
        $finding_data->status=$request->get('status');
        $finding_data->progress='0%';
        $finding_data->tipe_audit=$request->get('tipe_audit');
        $finding_data->jenis_audit=$request->get('jenis_audit');
        $finding_data->risk_level=$request->get('risk_level');
        $finding_data->kriteria_audit=$request->get('kriteria_audit');
        $finding_data->tahun_audit=$request->get('tahun_audit');
        $finding_data->tanggal_mulai_audit=$request->get('tanggal_mulai_audit');
        $finding_data->tanggal_akhir_audit=$request->get('tanggal_akhir_audit');
        $finding_data->auditor=$request->get('auditor');
        $finding_data->finding=$request->get('finding');
        $finding_data->root=$request->get('root');
        $finding_data->department=$department->nama_department;
        $finding_data->auditee=$request->get('auditee');
        $finding_data->corrective=$request->get('corrective');
        $finding_data->due_date=$request->get('due_date');
        $finding_data->no_audit=$request->get('no_laporan_audit');
        $finding_data->save();
        $jumlah_temuan = Finding::where('no_audit',$request->get('no_laporan_audit'))->count();
        $update_jumlah = Audit::where('no_audit',$request->get('no_laporan_audit'))->update([
            'jumlah_temuan' => $jumlah_temuan
        ]);
        session()->flash('berhasil', 'Data Finding Berhasil Ditambahkan');
        return redirect('/finding');
      
    }

    public function delete_finding($id){
        $finding =Finding::where("id_finding", $id);
        $finding->delete();
        session()->flash('berhasil', 'Data Finding Berhasil Dihapus');
        return redirect('/finding');
    }
}
