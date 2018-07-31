<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DELETED = 'deleted';
    const STATUS_EXPIRED = 'expired';

    protected $table = 'url';

    protected $fillable = [
        'id',
        'code',
        'url',
        'hits',
        'status',
        'create_at',
        'updated_at',
        'expires_in',
    ];
}
