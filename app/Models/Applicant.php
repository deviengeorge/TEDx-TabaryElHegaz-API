<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $table = "applicants";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = ["form_id"]; // Empty
    protected $hidden = ["pivot", "updated_at"];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
