<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\Department;
use App\Models\Finding;
use App\Models\Root;
use App\Models\JumlahTemuan;
use App\Models\CA;
use Auth;
use App\Exports\FindingExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class FindingController extends Controller
{
    public function index_finding(){
        $finding = Finding::leftjoin('jumlah_temuan','jumlah_temuan.id_finding','finding.id_finding')
        ->leftjoin('root','root.id_jumlah_temuan','jumlah_temuan.id_jumlah_temuan')
        ->leftjoin('corrective_action','corrective_action.id_root','root.id_root')
        ->select('finding.*','jumlah_temuan.item_finding','root.root_cause','corrective_action.*')
        ->get();
        $Audit = Audit::all();
        $Depart = Department::all();
        $Root = Root::all();
        $CA = CA::all();
        $depart_name = Department::where('id',Auth::user()->id_department)->first();
        if (Auth::user()->role == "auditee") {
            $finding = Finding::leftjoin('jumlah_temuan','jumlah_temuan.id_finding','finding.id_finding')
            ->leftjoin('root','root.id_jumlah_temuan','jumlah_temuan.id_jumlah_temuan')
            ->leftjoin('corrective_action','corrective_action.id_root','root.id_root')
            ->select('finding.*','jumlah_temuan.item_finding','root.root_cause','corrective_action.*')
            ->where('corrective_action.department',$depart_name->nama_department)
            ->get();
        }
        return view('finding.finding_index',compact('finding','Audit','Depart','Root','CA'));
    }


    public function data_tampil(Request $request){
        $laporan_audit = Audit::where('no_audit',$request->no_audit)->first();
        return response()->json([
            'data' => $laporan_audit
        ]);
    }

    public function tampil_finding(Request $request){
        $finding_audit = JumlahTemuan::where('id_audit',$request->no_audit)->get();
        return response()->json([
            'data' => $finding_audit
        ]);
    }

    public function tampil_finding_ca(Request $request){
        $finding_ca = JumlahTemuan::where('id_audit',$request->no_audit)->get();
        return response()->json([
            'data' => $finding_ca
        ]);
    }

    public function tampil_root_ca(Request $request){
        $root_ca = Root::where('id_jumlah_temuan',$request->no_audit)->get();
        return response()->json([
            'data' => $root_ca
        ]);
    }

    public function approve_ca(Request $request, $id){
        $status_ca= CA::where('id_corrective',$id)->first();
        $root_ca = Root::where('id_root',$status_ca->id_root)->first();
        $jumlah_temuan_ca = JumlahTemuan::where('id_jumlah_temuan',$root_ca->id_jumlah_temuan)->first();
        $id_audit = $jumlah_temuan_ca->id_audit;
        $progress_audit= Audit::where('no_audit',$id_audit)->first();
        $total_proses = JumlahTemuan::where('id_audit',$id_audit)->get();
        $count = 0;
        $sum_progress = 0;
     
        $current = Carbon::now();
        $data = [
            'status' => 'Close',
            'risk_after' => $request['risk_after'],
            'progress' => '100',
            'close_date' => $current

        ];
        // dd($perhitungan_progress);
        $status_ca->update($data);
        foreach ($total_proses as $key => $value) {
            $root_total = Root::where('id_jumlah_temuan',$value->id_jumlah_temuan)->get();
            foreach ($root_total as $key => $value) {
                $corrective_action_total = CA::where('id_root',$value->id_root)->get();
                    foreach ($corrective_action_total as $key => $value) {
                        $count += 1;
                        $sum_progress += $value->progress;
                }
            }
        }
        $perhitungan_progress = number_format($sum_progress/$count,2);
        $data2 = [
            'percentage_audit' => $perhitungan_progress
        ];
        $progress_audit->update($data2);
        session()->flash('berhasil', 'Finding Berhasil Disetujui');
        return redirect('/finding');
        // $status_ca=CA::where('id_corrective',$id)->first();
        // $status_ca->update([
        //     'status'=>'Close',
        //     'risk_after'=>$request['risk_after']
        // ]);
        // return redirect('/finding');
    }

     public function reject_ca_process(Request $request, $id){
        $cA = CA::where('id_corrective',$id);
        $data = [
            'comment' => $request['comment'],
            'kondisi' => NULL,
           
        ];
        $cA->update($data);
        session()->flash('berhasil', 'Comment Berhasil Ditambahkan');
        return redirect('/finding');

    }

    public function follow_up_ca(Request $request, $id){
        $cA = CA::where('id_corrective',$id);
        $file_evident = $request->file_fu;
        $fileName_evident = time().'_'.$file_evident->getClientOriginalName();
        $file_evident->move(public_path('storage/LaporanFollowUp'), $fileName_evident);
        $data = [
            'fu_corrective' => $request['fu_corrective'],
            'kondisi' => 'follow-up',
            'file_fu' =>  $fileName_evident 
        ];
        $cA->update($data);
        session()->flash('berhasil', 'Follow Up Corrective Action Berhasil Ditambahkan');
        return redirect('/finding');

    }

    public function insert_finding(Request $request){
        $validateData = $request->validate([
            "no_laporan_audit" => 'required|max:255',
            "judul_audit" => 'required|max:255',
            "tipe_audit" => 'required|max:255',
            "jenis_audit" => 'required|max:255',
            "kriteria_audit" => 'required|max:255',
            "tahun_audit" => 'required',
            "tanggal_mulai_audit" => 'required|date_format:Y-m-d',
            "tanggal_akhir_audit" => 'required|date_format:Y-m-d',
            "auditor" => 'required|max:255',
            "finding" => 'required|max:255'
        ]);
        // $validateData = $request->validate([
        //     "no_laporan_audit" => 'required|max:255',
        //     "judul_audit" => 'required|max:255',
        //     "status" => 'required|max:255',
        //     "tipe_audit" => 'required|max:255',
        //     "jenis_audit" => 'required|max:255',
        //     "risk_level" => 'required|max:255',
        //     "kriteria_audit" => 'required|max:255',
        //     "tahun_audit" => 'required',
        //     "tanggal_mulai_audit" => 'required|date_format:Y-m-d',
        //     "tanggal_akhir_audit" => 'required|date_format:Y-m-d',
        //     "auditor" => 'required|max:255',
        //     "finding" => 'required|max:255',
        //     "root" => 'required|max:255',
        //     "department" => 'required',
        //     "auditee" => 'required|max:255',
        //     "corrective" => 'required|max:255',
        //     "due_date" => 'required|date_format:Y-m-d'
        // ]);
        // if($validateData->fails()) {
        //     return Redirect::back()->withErrors($validateData);
        // }

        $laporan_audit=Audit::where('no_audit',$request->get('no_laporan_audit'))->first();
     
        $finding_data=new Finding;
        $finding_data->no_laporan_audit=$laporan_audit->no_laporan_audit;
        $finding_data->judul_audit=$request->get('judul_audit');
        $finding_data->tipe_audit=$request->get('tipe_audit');
        $finding_data->jenis_audit=$request->get('jenis_audit');
        $finding_data->kriteria_audit=$request->get('kriteria_audit');
        $finding_data->tahun_audit=$request->get('tahun_audit');
        $finding_data->tanggal_mulai_audit=$request->get('tanggal_mulai_audit');
        $finding_data->tanggal_akhir_audit=$request->get('tanggal_akhir_audit');
        $finding_data->auditor=$request->get('auditor');
        $finding_data->no_audit=$request->get('no_laporan_audit');
        $finding_data->save();

        $hasil_temuan = new JumlahTemuan;
        $hasil_temuan->item_finding=$request->get('finding');
        $hasil_temuan->id_finding=$finding_data->id_finding;
        $hasil_temuan->id_audit=$request->get('no_laporan_audit');
        $hasil_temuan->save();

        // $jumlah_temuan = Finding::where('no_audit',$request->get('no_laporan_audit'))->count();
        // $update_jumlah = Audit::where('no_audit',$request->get('no_laporan_audit'))->update([
        //     'jumlah_temuan' => $jumlah_temuan
        // $laporan_audit=Audit::where('no_audit',$request->get('no_laporan_audit'))->first();
        // $department=Department::where('id',$request->get('department'))->first();
        // $finding_data=new Finding;
        // $finding_data->no_laporan_audit=$laporan_audit->no_laporan_audit;
        // $finding_data->judul_audit=$request->get('judul_audit');
        // $finding_data->status=$request->get('status');
        // $finding_data->progress='0%';
        // $finding_data->tipe_audit=$request->get('tipe_audit');
        // $finding_data->jenis_audit=$request->get('jenis_audit');
        // $finding_data->risk_level=$request->get('risk_level');
        // $finding_data->kriteria_audit=$request->get('kriteria_audit');
        // $finding_data->tahun_audit=$request->get('tahun_audit');
        // $finding_data->tanggal_mulai_audit=$request->get('tanggal_mulai_audit');
        // $finding_data->tanggal_akhir_audit=$request->get('tanggal_akhir_audit');
        // $finding_data->auditor=$request->get('auditor');
        // $finding_data->finding=$request->get('finding');
        // $finding_data->root=$request->get('root');
        // $finding_data->department=$department->nama_department;
        // $finding_data->auditee=$request->get('auditee');
        // $finding_data->corrective=$request->get('corrective');
        // $finding_data->due_date=$request->get('due_date');
        // $finding_data->no_audit=$request->get('no_laporan_audit');
        // $finding_data->save();
        // $jumlah_temuan = Finding::where('no_audit',$request->get('no_laporan_audit'))->count();
        // $update_jumlah = Audit::where('no_audit',$request->get('no_laporan_audit'))->update([
        //     'jumlah_temuan' => $jumlah_temuan
        // ]);
        session()->flash('berhasil', 'Finding Berhasil Ditambahkan');
        return redirect('/finding');
      
    }

    public function insert_root(Request $request){
        $validateData = $request->validate([
            "nomor_laporan" => 'max:255',
            "pilih_finding" => 'max:255',
            "root_cause" => 'max:255'
        ]);
        $root_data=new Root;
        $root_data->id_jumlah_temuan=$request->get('pilih_finding');
        $root_data->root_cause=$request->get('root_cause');
        $root_data->save();
        session()->flash('berhasil', 'Root Berhasil Ditambahkan');
        return redirect('/finding');
    }

    public function insert_CA(Request $request){
        $audit_date = Finding::where('no_audit',$request->nomor_laporan_ca)->first();
        $audit_filter_date = $audit_date->tanggal_akhir_audit;
  
        $validateData = $request->validate([
            "nomor_laporan_ca" => 'max:255',
            "pilih_finding_caa" => 'max:255',
            "pilih_root" => 'max:255',
            "department" => 'required',
            "risk_level" => 'max:255',
            "due_date" => 'date_format:Y-m-d|before_or_equal:' . $audit_filter_date,
            "ca" => 'max:255'

        ]);
        $department=Department::where('id',$request->get('department'))->first();
        $ca_data=new CA;
        $ca_data->id_root=$request->get('pilih_root');
        $ca_data->department=$department->nama_department;
        $ca_data->risk_level=$request->get('risk_level');
        $ca_data->due_date=$request->get('due_date');
        $ca_data->corrective=$request->get('ca');
        $ca_data->status='Open';
        $ca_data->progress='0';
        $ca_data->save();
        session()->flash('berhasil', 'Corrective Action Berhasil Ditambahkan');
        return redirect('/finding');
    }


    public function edit_finding($id){

        $jumlah_temuan = CA::where('id_corrective',$id)->first();
        $department = Department::all();

        return view('finding.edit_finding',compact('jumlah_temuan','department'));
    }

    public function edit_finding_process(Request $request){
        $jumlah_temuan = CA::where('id_corrective', $request['id_corrective']);
        
        $data = [
            'progress' => $request['progress'],
            
        ];
        $jumlah_temuan->update($data);
        session()->flash('berhasil', 'Item Audit Berhasil Diubah');
        return redirect('/finding');

    }

    public function delete_finding($id){
        $finding =JumlahTemuan::where("id_jumlah_temuan", $id);
        $finding->delete();
        // $hancur = JumlahTemuan::where('id_finding',$id)->get();
        // foreach ($hancur as $key => $value) {
        //     $value->delete();
        // }
        session()->flash('berhasil', 'Finding Berhasil Dihapus');
        return redirect('/finding');
    }
}
