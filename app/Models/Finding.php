<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finding extends Model
{
    use HasFactory;
    protected $table = 'finding';
    protected $primaryKey = 'id_finding';
    protected $fillable = ['id_finding','no_audit','no_laporan_audit','judul_audit','status','progress','tipe_audit','jenis_audit','risk_level','kriteria_audit','tahun_audit','tanggal_mulai_audit','tanggal_akhir_audit','auditor','finding','root','department','auditee','corrective','due_date','file'];

}
