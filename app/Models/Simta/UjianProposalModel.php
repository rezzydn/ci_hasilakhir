<?php

namespace App\Models\Simta;

use CodeIgniter\Model;

class UjianProposalModel extends Model
{
    protected $uuidFields       = ['id_ujianproposal'];
    protected $table            = 'simta_ujianproposal';
    protected $primaryKey       = 'id_ujianproposal';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_ujianproposal', 'id_mhs', 'id_staf', 'nama_judul', 
                                   'abstrak', 'ruang_sempro', 'tanggal', 
                                   'nilai_up', 'status_up', 'catatan', 'proposalawal', 'created_at', 'update_at'];
    protected $validationRules = ['id_ujianproposal' => 'required'];
                               
    function getUjianProposalByUser()
    {   
        $user_id = user()->id;
        $builder = $this->db->table('simta_ujianproposal');
        $builder->select('simta_ujianproposal.*, mahasiswa.*, staf.*, staf.nama as nm_staf,mahasiswa.nama as nm_mhs'); 
        $builder->join('mahasiswa', 'mahasiswa.id_mhs = simta_ujianproposal.id_mhs');
        $builder->join('staf', 'staf.id_staf = simta_ujianproposal.id_staf');
        $builder->join('users', 'users.id = mahasiswa.id_user');
        $builder->where(['mahasiswa.id_user' => $user_id]);
        $query = $builder->get();
        return $query->getResult();
    }

    function getUjianProposalByUser1()
    {   
        $user_id = user()->id;
        $builder = $this->db->table('simta_ujianproposal');
        $builder->select('simta_ujianproposal.*, mahasiswa.*, staf.*, staf.nama as nm_staf,mahasiswa.nama as nm_mhs'); 
        $builder->join('mahasiswa', 'mahasiswa.id_mhs = simta_ujianproposal.id_mhs');
        $builder->join('staf', 'staf.id_staf = simta_ujianproposal.id_staf');
        $builder->join('users', 'users.id = staf.id_user');
        $builder->where(['staf.id_user' => $user_id]);
        $query = $builder->get();
        return $query->getResult();
    }

    function getDetailUjianProposal()
    {
        $builder = $this->db->table('simta_penguji_ujianproposal AS s');
        $builder->select('s.id_penguji_ujianproposal, IFNULL(sub_count.jumlah_staf, 0) AS jumlah_staf, st.nama AS nama_dosen, s.nama_penguji, b.nama_penguji');
        $builder->join('simta_penguji_ujianproposal_dosen AS sd', 's.id_penguji_ujianproposal = sd.id_penguji_ujianproposal');
        $builder->join('staf AS st', 'sd.id_staf = st.id_staf');
        $builder->join('simta_ujianproposal AS b', 'b.id_ujianproposal = s.id_ujianproposal');
        $builder->join('(SELECT id_penguji_ujianproposal, COUNT(id_staf) AS jumlah_staf FROM simta_penguji_ujianproposal_dosen GROUP BY id_penguji_ujianproposal) AS sub_count', 's.id_penguji_ujianproposal = sub_count.id_penguji_ujianproposal', 'left');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDataByIdUjianProposal($id_ujianproposal)
    {
        $builder = $this->db->table('simta_penguji_ujianproposal');
        $builder->where('id_ujianproposal', $id_ujianproposal);
        $builder->findAll();
    }
}