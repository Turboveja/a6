<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Promotor
 * @package App\Models\Models
 */
class Promotor extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'promotores';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id', 'nombre', 'email'
    ];
}
