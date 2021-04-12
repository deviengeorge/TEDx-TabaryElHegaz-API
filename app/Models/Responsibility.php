<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsibility extends Model
{
    use HasFactory;
    protected $table = "responsibilities";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "content",
        "form_id"
    ];
}
