<?php

namespace App\Models\Simta;

use CodeIgniter\Model;

class UjianTAModel extends Model
{
    protected $uuidFields       = ['id_ujianta'];
    protected $table            = 'simta_ujianta';
    protected $primaryKey       = 'id_ujianta';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_ujianta', 'id_mhs', 'id_staf', 'nama_judul', 
                                   'abstrak','ruangan', 'tanggal',  
                                   'nilai_ut', 'status_ut', 'catatan', 'proposalakhir','created_at', 'update_at'];
    protected $validationRules = ['id_ujianta' => 'required'];
                               
    function getUjianTAByUser()
    {   
        $user_id = user()->id;
        $builder = $this->db->table('simta_ujianta');
        $builder->select('simta_ujianta.*, mahasiswa.*, staf.*, staf.nama as nm_staf,mahasiswa.nama as nm_mhs'); 
        $builder->join('mahasiswa', 'mahasiswa.id_mhs = simta_ujianta.id_mhs');
        $builder->join('staf', 'staf.id_staf = simta_ujianta.id_staf');
        $builder->join('users', 'users.id = mahasiswa.id_user');
        $builder->where(['mahasiswa.id_user' => $user_id]);
        $query = $builder->get();
        return $query->getResult();
    }

    function getUjianTAByUser1()
    {   
        $user_id = user()->id;
        $builder = $this->db->table('simta_ujianta');
        $builder->select('simta_ujianta.*, mahasiswa.*, staf.*, staf.nama as nm_staf,mahasiswa.nama as nm_mhs'); 
        $builder->join('mahasiswa', 'mahasiswa.id_mhs = simta_ujianta.id_mhs');
        $builder->join('staf', 'staf.id_staf = simta_ujianta.id_staf');
        $builder->join('users', 'users.id = staf.id_user');
        $builder->where(['staf.id_user' => $user_id]);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDataByIdUjianTA($id_ujianta)
    {
        $builder = $this->db->table('simta_penguji_ujianta');
        $builder->where('id_ujianta', $id_ujianta);
        $builder->findAll();
    }
}