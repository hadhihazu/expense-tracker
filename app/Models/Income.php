<?php

namespace App\Models;

use App\Models\User;
use App\Models\Source;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'source_id',
        'date'
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
