<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PZEM;
use App\Models\DHT;

class Device extends Model
{
    // Table Name 
    protected $table = 'devices';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps = true;
    
    protected $fillable = ['name', 'note', 'dht_name', 'pzem_name', 'fk_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function dht(){
        return $this->hasMany(DHT::class, 'fk_id', 'id');
    }

    public function pzem(){
        return $this->hasMany(PZEM::class, 'fk_id', 'id');
    }
}
