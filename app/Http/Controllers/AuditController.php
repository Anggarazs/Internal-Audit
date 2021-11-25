<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\Department;
use App\Models\Finding;
use App\Models\JumlahTemuan;
use App\Models\Root;
use DB;

class AuditController extends Controller
{
    public function index_audit(){
        $audit =DB::table('laporan_audit')
        ->join('department','laporan_audit.department','=','department.id')
        ->select('laporan_audit.*','department.nama_department')
        ->get();
        $department = Department::all();
        $finding_total = DB::table('jumlah_temuan')->count();       
        $root_total=DB::table('root')->count();
        $corrective_total=DB::table('corrective_action')->count();
        return view('audit.audit_index',compact('audit','department','finding_total','root_total','corrective_total'));
    }

    public function view_insert_audit(){
        $audit =DB::table('laporan_audit')
        ->join('department','laporan_audit.department','=','department.id')
        ->select('laporan_audit.*','department.nama_department')
        ->get();
        $department = Department::all();
        return view('audit.insert_audit',compact('audit','department'));
    }

    public function view_detail_audit($id){
        $audit = Audit::findOrFail($id);
        $department = Department::all();
        $finding = Finding::all();
        return view('audit.detail_audit',compact('audit','department','finding'));
    }

    public function insert_audit(Request $request){

        $validateData = $request->validate([
            "no_laporan_audit" => 'required|max:255',
            "judul_audit" => 'required|max:255',
            "status_audit" => 'required|max:255',
            "tipe_audit" => 'required|max:255',
            "jenis_audit" => 'required|max:255',
            "objek" => 'required|max:255',
            "auditor" => 'required|max:255',
            "department" => 'required',
            "kriteria_audit" => 'required|max:255',
            "tahun_audit" => 'required',
            "tanggal_mulai_audit" => 'required|date_format:Y-m-d',
            "tanggal_akhir_audit" => 'required|date_format:Y-m-d',
            "file" => 'mimes:pdf,jpg,jpeg,png|max:10000'
        ]);

        $dokumen=$request->judul_audit.'.'.$request->file->extension();
        $request->file->move(storage_path('app/public/LaporanAudit'),$dokumen);
        
        $audit=new Audit;
        $audit->no_laporan_audit=$request->get('no_laporan_audit');
        $audit->judul_audit=$request->get('judul_audit');
        $audit->status_audit=$request->get('status_audit');
        $audit->percentage_audit='0%';
        $audit->tipe_audit=$request->get('tipe_audit');
        $audit->jenis_audit=$request->get('jenis_audit');
        $audit->objek=$request->get('objek');
        $audit->auditor=$request->get('auditor');
        $audit->department=$request->get('department');
        $audit->kriteria_audit=$request->get('kriteria_audit');
        $audit->tahun_audit=$request->get('tahun_audit');
        $audit->tanggal_mulai_audit=$request->get('tanggal_mulai_audit');
        $audit->tanggal_akhir_audit=$request->get('tanggal_akhir_audit');
        $audit->jumlah_temuan=$request->get('jumlah_temuan');
        $audit->root_audit='0';
        $audit->corrective_action='0';
        $audit->file=$dokumen;
        $audit->save();

        session()->flash('berhasil', 'Event Audit Berhasil Ditambahkan');
        return redirect('/audit');
        
    }

    public function edit_audit($id){

        $audit =Audit::where("no_audit", $id)->first();
        $department = Department::all();
        return view('audit.edit_audit', ['department' => $department,'audit' => $audit]);
        // return view('audit.edit_audit',compact('audit'));
    }

    public function edit_audit_process(Request $request){
        $audit = Audit::where('no_audit', $request['no_audit']);
        $dokumen=$request->judul_audit.'.'.$request->file->extension();
        // $file_data_laporan_audit = $request->file;
        // $fileName_data_laporan_audit = time().'_'.$file_data_laporan_audit->getClientOriginalName();
        // $file_data_laporan_audit->move(public_path('storage/file-peminjaman/data-diri-penanggungjawab'), $fileName_data_diri_penanggungjawab);

        $data = [
            'no_laporan_audit' => $request['no_laporan_audit'],
            'judul_audit' =>  $request['judul_audit'],
            'status_audit' =>  $request['status_audit'],
            'percentage_audit' =>  $request['percentage_audit'],
            'jenis_audit' =>  $request['jenis_audit'],
            'objek' =>  $request['objek'],
            'auditor' => $request['auditor'],
            'department' =>  $request['department'],
            'kriteria_audit' =>  $request['kriteria_audit'],
            'tahun_audit' => $request['tahun_audit'],
            'tanggal_mulai_audit' =>  $request['tanggal_mulai_audit'],
            'tanggal_akhir_audit' =>  $request['tanggal_akhir_audit'],
            'file' => $dokumen,
        ];

        $request->file->move(storage_path('app/public/LaporanAudit'),$dokumen);
        $audit->update($data);
        session()->flash('berhasil', 'Event Audit Berhasil Diubah');
        return redirect('/audit');

        

    }

    public function delete_audit($id){
        $audit =Audit::where("no_audit", $id);
        $audit->delete();
        session()->flash('berhasil', 'Event Audit Berhasil Dihapus');
        return redirect('/audit');
    }
}
