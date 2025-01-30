<?php

namespace App\Models;

use App\Models\User;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'user_id'];

    // Relationship: A category belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A category has many expenses
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
