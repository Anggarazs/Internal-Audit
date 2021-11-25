<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahTemuan extends Model
{
    use HasFactory;
    protected $table = 'jumlah_temuan';
    protected $primaryKey = 'id_jumlah_temuan';
    protected $fillable = ['id_jumlah_temuan','item_finding'];
}
