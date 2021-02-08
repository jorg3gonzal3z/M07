<?php

namespace App\Repositories;

use App\Models\Mascota;
use App\Repositories\BaseRepository;

/**
 * Class MascotaRepository
 * @package App\Repositories
 * @version February 8, 2021, 4:38 pm UTC
*/

class MascotaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'tipus'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Mascota::class;
    }
}
