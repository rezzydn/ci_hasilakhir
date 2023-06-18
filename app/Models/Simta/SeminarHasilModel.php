<?php

namespace App\Models\Simta;

use CodeIgniter\Model;

class SeminarHasilModel extends Model
{
    protected $uuidFields       = ['id_seminarhasil'];
    protected $table            = 'simta_seminarhasil';
    protected $primaryKey       = 'id_seminarhasil';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_seminarhasil', 'id_mhs', 'id_staf', 'nama_judul', 
                                   'abstrak', 'ruang_semhas', 'jadwal_semhas', 
                                   'nilai_total', 'status_sh', 'catatan', 'link_file'];
    protected $validationRules = ['id_seminarhasil' => 'required'];
                               
    function getSeminarHasilByUser()
    {   
        $user_id = user()->id;
        $builder = $this->db->table('simta_seminarhasil');
        $builder->select('simta_seminarhasil.*, mahasiswa.*, staf.*, staf.nama as nm_staf,mahasiswa.nama as nm_mhs'); 
        $builder->join('mahasiswa', 'mahasiswa.id_mhs = simta_seminarhasil.id_mhs');
        $builder->join('staf', 'staf.id_staf = simta_seminarhasil.id_staf');
        $builder->join('users', 'users.id = mahasiswa.id_user');
        $builder->where(['mahasiswa.id_user' => $user_id]);
        $query = $builder->get();
        return $query->getResult();
    }

    function getseminarhasilByUser1()
    {   
        $user_id = user()->id;
        $builder = $this->db->table('simta_seminarhasil');
        $builder->select('simta_seminarhasil.*, mahasiswa.*, staf.*, staf.nama as nm_staf,mahasiswa.nama as nm_mhs'); 
        $builder->join('mahasiswa', 'mahasiswa.id_mhs = simta_seminarhasil.id_mhs');
        $builder->join('staf', 'staf.id_staf = simta_seminarhasil.id_staf');
        $builder->join('users', 'users.id = staf.id_user');
        $builder->where(['staf.id_user' => $user_id]);
        $query = $builder->get();
        return $query->getResult();
    }
}