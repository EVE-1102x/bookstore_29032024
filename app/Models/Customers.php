<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = [
        'CLevel',
        'created_by'
    ];
}
