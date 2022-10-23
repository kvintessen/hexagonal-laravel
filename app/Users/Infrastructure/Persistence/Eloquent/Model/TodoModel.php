<?php

namespace App\Users\Infrastructure\Persistence\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class TodoModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];
}
