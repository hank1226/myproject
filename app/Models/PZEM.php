<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use App\Models\PZEMrecord;

class PZEM extends Model
{
    // Table Name 
    protected $table = 'pzem';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps = true;

    public function devices(){
        return $this->belongsTo(Device::class);
    }

    public function pzemrecords(){
        return $this->hasMany(PZEMrecord::class, 'fk_id', 'id');
    }
}
