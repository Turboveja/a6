<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Medio
 * @package App\Models\Models
 */
class Medio extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'medios';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id','nombre'
    ];
}
