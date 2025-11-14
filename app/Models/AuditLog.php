<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'status',
        'perfomed_by',
        'confirmed_by',
        'transfer_code',
        'amount',
    ];
}
