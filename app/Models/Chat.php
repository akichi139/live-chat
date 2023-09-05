<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['message','from_user_id','to_user_id','is_read'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}
