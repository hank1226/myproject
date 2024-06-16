<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DHT;

class DHTrecord extends Model
{
    // Table Name 
    protected $table = 'dhtrecords';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps = false;

    public function dht(){
        return $this->belongsTo(DHT::class, 'fk_id', 'id');
    }
}
