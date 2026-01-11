<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class resume extends Model
{
    use HasFactory;
    protected $table = "resumes";
    protected $fillable = ['image', 'periode', 'pekerjaan'];
}
