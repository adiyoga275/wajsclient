<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'ack',
        'from',
        'to',
        'type',
        'body',
        'fromMe',
        'attachmentType',
        'attachmentLink',
        'deviceType',
        'timestamp',
        'isRead',
    ];
}
