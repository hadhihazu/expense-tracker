<?php

namespace App\Models;

use App\Models\User;
use App\Models\Income;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }
}
