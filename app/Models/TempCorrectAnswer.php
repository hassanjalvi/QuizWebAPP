<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempCorrectAnswer extends Model
{
    use HasFactory;

    protected $table = 'temp_correct_answers';

    // Define the fillable attributes
    protected $fillable = [
       
        'user_answer',
    ];

    // Optionally define relationships if needed
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
