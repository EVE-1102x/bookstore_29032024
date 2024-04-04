<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $table = 'Books';
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'CategoryID',
        'AuthorID',
        'PublisherID',
        'stock',
    ];
}
