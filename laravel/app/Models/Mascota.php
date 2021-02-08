<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Mascota
 * @package App\Models
 * @version February 8, 2021, 4:38 pm UTC
 *
 * @property string $nom
 * @property string $tipus
 */
class Mascota extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'mascotas';
    public $timestamps = false;
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom',
        'tipus'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'tipus' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'required|string',
        'tipus' => 'required|string'
    ];

    
}
