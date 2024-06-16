<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PZEM;


class PZEMrecord extends Model
{
    // Table Name 
    protected $table = 'pzemrecords';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps = false;

    public function pzem(){
        return $this->belongsTo(PZEM::class, 'fk_id', 'id');
    }
}
