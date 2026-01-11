<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class blog extends Model
{
    use HasFactory;
    protected $table = "blogs";
    protected $fillable = ['judul', 'kategori', 'deskripsi', 'foto_blog'];
}
