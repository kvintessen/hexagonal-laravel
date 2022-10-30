<?php

namespace App\Users\Infrastructure\Persistence\Eloquent\Model;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Users\Infrastructure\Persistence\Eloquent\Model\TodoModel.
 *
 * @method static Builder|TodoModel newModelQuery()
 * @method static Builder|TodoModel newQuery()
 * @method static Builder|TodoModel query()
 * @mixin Eloquent
 * @mixin Builder
 */
final class TodoModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];
}
