<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Grupo
 * @package App\Models\Models
 */
class Grupo extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'conciertos';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id','nombre','cache'
    ];
}
