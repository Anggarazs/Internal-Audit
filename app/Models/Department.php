<?php

namespace App\Models;

use App\Models\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    protected $primaryKey = 'id';
    protected $fillable = ['id','nama_department'];
    
 
}
