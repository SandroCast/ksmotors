<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['from', 'to', 'content'];

    public function userfrom() {
        return $this->belongsTo(User::class, 'from', 'id');
    }
    public function userto() {
        return $this->belongsTo(User::class, 'to', 'id');
    }

    protected $casts = [
        'properties' => 'collection',
        'created_at' => 'datetime:d/m/Y H:i',
    ];
    protected $dates = ['created_at'];

}
