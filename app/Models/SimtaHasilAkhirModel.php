<?php

namespace App\Models;

use CodeIgniter\Model;

class SimtaHasilakhirModel extends Model
{
    protected $table = 'simta_hasilakhir';
    protected $primaryKey = 'id_hasilakhir';
    protected $allowedFields = [
        'id_ujianproposal',
        'id_seminarhasil',
        'id_ujianta',
        'id_mhs',
        'id_staf',
        'hasil_akhir',
        'created_at',
        'updated_at'
    ];

    public function getHasilakhir()
    {
        $builder = $this->db->table($this->table);
        $builder->select('simta_hasilakhir.*, ujianproposal.nilai_total AS nilai_total, seminarhasil.nilai_total AS nilai_total, ujianta.nilai_total AS nilai_total, mahasiswa.nama AS nama, staf.nama AS nama');
        $builder->join('simta_ujianproposal', 'simta_ujianproposal.id = simta_hasilakhir.id_ujianproposal', 'left');
        $builder->join('simta_seminarhasil', 'simta_seminarhasil.id_seminarhasil = simta_hasilakhir.id_seminarhasil', 'left');
        $builder->join('simta_ujianta', 'simta_ujianta.id_ujianta = simta_hasilakhir.id_ujianta', 'left');
        $builder->join('mahasiswa', 'mahasiswa.id_mhs = simta_hasilakhir.id_mhs', 'left');
        $builder->join('staf', 'staf.id_staf = simta_hasilakhir.id_staf', 'left');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getUjianProposalOptions()
    {
        $builder = $this->db->table('simta_ujianproposal');
        $builder->select('id_ujianproposal, nilai_total');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getSeminarHasilOptions()
    {
        $builder = $this->db->table('simta_seminarhasil');
        $builder->select('id_seminarhasil, nilai_total');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getUjianTaOptions()
    {
        $builder = $this->db->table('simta_ujianta');
        $builder->select('id_ujianta, nilai_total');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getMahasiswaOptions()
    {
        $builder = $this->db->table('mahasiswa');
        $builder->select('id_user, nama');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getStafOptions()
    {
        $builder = $this->db->table('staf');
        $builder->select('id_user, nama');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getTotalNilaiUjianProposal($id_hasilakhir){
        $builder = $this->db->table('simta_hasilakhir');
        $builder->selectSum('nilai_ujianproposal');
        $query = $builder->get()->getResult(); 

        foreach ($query as $key => $value) {
            return $value->nilai_ujianproposal;
        }
    }
    
    public function getTotalNilaiSeminarHasil($id_hasilakhir){
        $builder = $this->db->table('simta_hasilakhir');
        $builder->selectSum('nilai_seminarhasil');
        $query = $builder->get()->getResult(); 

        foreach ($query as $key => $value) {
            return $value->nilai_seminarhasil;
        }
    }

    public function getTotalNilaiUjianTA($id_hasilakhir){
        $builder = $this->db->table('simta_hasilakhir');
        $builder->selectSum('nilai_ujianta');
        $query = $builder->get()->getResult(); 

        foreach ($query as $key => $value) {
            return $value->nilai_ujianta;
        }
    }
}
