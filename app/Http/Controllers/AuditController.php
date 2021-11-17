<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\Department;
use DB;

class AuditController extends Controller
{
    public function index_audit(){
        $audit =DB::table('laporan_audit')
        ->join('department','laporan_audit.department','=','department.id')
        ->select('laporan_audit.*','department.nama_department')
        ->get();
        $department = Department::all();
        return view('audit.audit_index',compact('audit','department'));
    }

    public function insert_audit(Request $request){
       // Andi Implementation
    //     $string = "";
    //     $new_var = $request->jenis_audit;
    // foreach ($new_var as $key => $value) {
    //     $jenis1 = JenisAudit::where('id_jenis_audit',$value)->first();
    //     $string =$string.$jenis1->jenis_audit.', ';
    // }
    //     echo $string;
        $validateData = $request->validate([
            "no_laporan_audit" => 'required|max:255',
            "judul_audit" => 'required|max:255',
            "tipe_audit" => 'required|max:255',
            "jenis_audit" => 'required|max:255',
            "objek" => 'required|max:255',
            "auditor" => 'required|max:255',
            "department" => 'required',
            "kriteria_audit" => 'required|max:255',
            "tahun_audit" => 'required',
            "tanggal_mulai_audit" => 'required|date_format:Y-m-d',
            "tanggal_akhir_audit" => 'required|date_format:Y-m-d',
            "jumlah_temuan" => 'required',
            "file" => 'mimes:pdf,jpg,jpeg,png|max:10000'
        ]);
     
        // $jenis1 = JenisAudit::where('id_jenis_audit','1')->first();
        // $jenis2 = JenisAudit::where('id_jenis_audit','2')->first();
        // $string = $jenis1->jenis_audit.', '.$jenis2->jenis_audit;

        $dokumen=$request->judul_audit.'.'.$request->file->extension();
        $request->file->move(storage_path('app/public/LaporanAudit'),$dokumen);
        
        $audit=new Audit;
        $audit->no_laporan_audit=$request->get('no_laporan_audit');
        $audit->judul_audit=$request->get('judul_audit');
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
        $audit->file=$dokumen;
        // $audit->jenis_audit()->attach($request->jenis_audit);
        $audit->save();

        session()->flash('berhasil', 'Laporan Audit Berhasil Ditambahkan');
        return redirect('/audit');
        

          // $audit=Audit::create([
        //     'no_laporan_audit'=>$request->no_laporan_audit,
        //     'judul_audit'=>$request->judul_audit,
        //     'tipe_audit'=>$request->tipe_audit,
        //     'objek'=>$request->objek,
        //     'auditor'=>$request->auditor,
        //     'department'=>$request->department,
        //     'kriteria_audit'=>$request->kriteria_audit,
        //     'tahun_audit'=>$request->tahun_audit,
        //     'tanggal_mulai_audit'=>$request->tanggal_mulai_audit,
        //     'tanggal_akhir_audit'=>$request->tanggal_akhir_audit,
        //     'jumlah_temuan'=>$request->jumlah_temuan,
        //     'file'=>$dokumen
        // ]);

        // $jenis_audit=$request->jenis_audit;
        // $audit->jenis_audit()->sync($jenis_audit);
   
      

        // if ($audit->save()) {
        //     $jenis->jenis_audit=$request->get('jenis_audit');
        //     $audit->jenis_audit()->sync($jenis);
        // }
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
        

        $data = [
            'no_laporan_audit' => $request['no_laporan_audit'],
            'judul_audit' =>  $request['judul_audit'],
            'tipe_audit' =>  $request['tipe_audit'],
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
        session()->flash('berhasil', 'Laporan Audit Berhasil Diubah');
        return redirect('/audit');


    }
    //     $validateData = $request->validate([
    //         "no_laporan_audit" => 'required|max:255',
    //         "judul_audit" => 'required|max:255',
    //         "tipe_audit" => 'required|max:255',
    //         "jenis_audit" => 'required|max:255',
    //         "objek" => 'required|max:255',
    //         "auditor" => 'required|max:255',
    //         "department" => 'required',
    //         "kriteria_audit" => 'required|max:255',
    //         "tahun_audit" => 'required',
    //         "tanggal_mulai_audit" => 'required|date_format:Y-m-d',
    //         "tanggal_akhir_audit" => 'required|date_format:Y-m-d',
    //         "jumlah_temuan" => 'required',
    //         "file" => 'mimes:pdf,jpg,jpeg,png|max:10000'
    //     ]);
    //     $dokumen=$request->judul_audit.'.'.$request->file->extension();
    //     $request->file->move(storage_path('app/public/LaporanAudit'),$dokumen);
        
    //     if ($validateData) {
    //         $audit = Audit::where('no_audit', $request['no_audit'])
    //         ->update(['no_laporan_audit' => $request["no_laporan_audit"], 'judul_audit' => $request["judul_audit"], 'tipe_audit' => $request["tipe_audit"], 'jenis_audit' => $request["jenis_audit"], 'objek' => $request["objek"],
    //         'auditor' => $request["auditor"],'department' => $request["department"],'kriteria_audit' => $request["kriteria_audit"],'tahun_audit' => $request["tahun_audit"],'tanggal_mulai_audit' => $request["tanggal_mulai_audit"],
    //         'tanggal_akhir_audit' => $request["tanggal_akhir_audit"],'jumlah_temuan' => $request["jumlah_temuan"],'file' => $request["file"]]);

    //         if ($audit) {
    //             session()->flash('berhasil', 'Akun Berhasil Diubah');
    //             return redirect('/audit');
    //         } else {
    //             session()->flash('gagal', 'Akun Gagal Diubah');
    //             return redirect('/edit_audit/' . $request["no_audit"]);
    //         }
    //     }
    // }

    public function delete_audit($id){
        $audit =Audit::where("no_audit", $id);
        $audit->delete();
        session()->flash('berhasil', 'Laporan Audit Berhasil Dihapus');
        return redirect('/audit');
    }
}
