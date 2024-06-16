<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use App\Models\DHTrecord;


class DHT extends Model
{
    // Table Name 
    protected $table = 'dht';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = ['name', 'dht_sn', 'fk_id'];

    public function devices(){
        return $this->belongsTo(Device::class);
    }

    public function dhtrecords(){
        return $this->hasMany(DHTrecord::class, 'fk_id', 'id');
    }
}
