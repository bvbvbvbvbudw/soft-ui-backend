<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpAdress extends Model
{
    use HasFactory;
    protected $table = 'ip_address';
    public $timestamps = false;
    protected $fillable = [
        'ip',
        'score',
    ];
}
