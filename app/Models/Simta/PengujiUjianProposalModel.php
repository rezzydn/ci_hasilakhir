<?php

namespace App\Models\Simta;

use CodeIgniter\Model;

class PengujiUjianProposalModel extends Model
{
    protected $uuidFields       = ['id_penguji_ujianproposal'];
    protected $table            = 'simta_penguji_ujianproposal';
    protected $useTimestamps    = false;
    protected $primaryKey       = 'id_penguji_ujianproposal';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_penguji_ujianproposal', 'id_staf','id_ujianproposal', 'nama_penguji', 'created_at', 'updated_at'];
    protected $validationRules = [
        'id_penguji_ujianproposal' => 'required'
    ];

    public function getDataByIdUjianProposal($id_ujianproposal)
    {
        return $this->where('id_ujianproposal', $id_ujianproposal)
                    ->findAll();
    }
}