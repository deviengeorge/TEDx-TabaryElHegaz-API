<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormQuestion extends Model
{
    use HasFactory;
    protected $table = "form_question";
    protected $primaryKey = "id";
    public $timestamps = false;
}
