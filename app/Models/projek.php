<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class projek extends Model
{
    use HasFactory;
    protected $table = "projeks";
    protected $fillable = ['foto_projeks', 'nama_projeks', 'deskripsi'];
}
