<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    // Table Name
    protected $table = 'posts';
    // Primary Key
    public $primarykey = 'id';
    //Timestamps
    public $timestamps = true;
    // make relationship with User Model
    public function user(){
        return $this->belongsTo(User::class);
    }
}
