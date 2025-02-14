<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Maillog extends Model
{
    use HasFactory, SoftDeletes;
    protected $guard = "maillogs";
    protected $casts = [
        'emails' => 'array'
    ];

    protected $fillable = [
        'subject',
        'message',
        'emails'
    ];
}
