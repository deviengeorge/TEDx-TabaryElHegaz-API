<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;
    protected $table = "requirements";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "content",
        "form_id"
    ];
}
