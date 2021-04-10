<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = "answers";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "answer",
        "applicant_id"
    ];
    protected $hidden = ["applicant_id"]; // to hide applicants id from the answers table API

    public function question()
    {
        return $this->hasOne(Question::class);
    }
}
