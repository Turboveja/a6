<?php

namespace App\Models;

use App\Models\Models\Grupo;
use App\Models\Models\Medio;
use App\Models\Models\Promotor;
use App\Models\Models\Recinto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Concierto
 * @package App\Models
 */
class Concierto extends Model
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
        'id','id_promotor','id_recinto','nombre','numero_espectadores','fecha','rentabilidad'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'grupos_conciertos', 'id_concierto', 'id_grupo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mediosPublicitarios()
    {
        return $this->belongsToMany(Medio::class, 'grupos_medios', 'id_concierto', 'id_medio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recinto()
    {
        return $this->hasOne(Recinto::class, 'id', 'id_rencito');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function promotor()
    {
        return $this->hasOne(Promotor::class, 'id', 'id_promotor');
    }
}
