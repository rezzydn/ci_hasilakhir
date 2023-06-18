<?php

namespace App\Models\Simta;

use CodeIgniter\Model;

class PengujiUjianTAModel extends Model
{
    protected $uuidFields       = ['id_penguji_ujianta'];
    protected $table            = 'simta_penguji_ujianta';
    protected $useTimestamps    = false;
    protected $primaryKey       = 'id_penguji_ujianta';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_penguji_ujianta', 'id_staf','id_ujianta', 'nama_penguji', 'created_at', 'updated_at'];
    protected $validationRules = [
        'id_penguji_ujianta' => 'required'
    ];

    public function getDataByIdUjianTA($id_ujianta)
    {
        return $this->where('id_ujianta', $id_ujianta)
                    ->findAll();
    }
}