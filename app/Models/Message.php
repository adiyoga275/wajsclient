<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'name',
        'type',
        'body',
        'attachment_type',
        'attachment_link',
        'is_read',
    ];
}
