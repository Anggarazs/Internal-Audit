<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CA extends Model
{
    use HasFactory;
    protected $table = 'corrective_action';
    protected $primaryKey = 'id_corrective';
    protected $fillable = ['id_corrective','corrective','status','department','risk_level','risk_after','due_date','close_date','comment','progress'];
}
