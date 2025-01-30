<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'category_id',
        'date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: An expense belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
