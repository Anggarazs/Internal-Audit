<?php

namespace App\Models;

use App\Models\JenisAudit;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Audit extends Model
{
    protected $table = 'laporan_audit';
    protected $primaryKey = 'no_audit';
    protected $fillable = ['no_audit','no_laporan_audit','judul_audit','status_audit','percentage_audit','tipe_audit','jenis_audit','objek','auditor','department','kriteria_audit','tahun_audit','tanggal_mulai_audit','tanggal_akhir_audit','jumlah_temuan','root_audit','corrective_action','file'];

    public function Depart(){
        return $this->belongsTo(Department::class,'department','id');
    }
}
