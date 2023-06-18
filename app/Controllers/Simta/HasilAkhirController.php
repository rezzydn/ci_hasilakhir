<?php

namespace App\Controllers;

use App\Models\SimtaHasilakhirModel;

class HasilAkhirController extends BaseController
{
    public function index()
    {
        $model = new SimtaHasilakhirModel();
        $data['hasilakhirs'] = $model->getHasilakhir();

        return view('hasilakhir/index', $data);
    }

    public function create()
    {
        $model = new SimtaHasilakhirModel();

        $data['ujianproposalOptions'] = $model->getUjianProposalOptions();
        $data['seminarhasilOptions'] = $model->getSeminarHasilOptions();
        $data['ujiantaOptions'] = $model->getUjianTaOptions();
        $data['mahasiswaOptions'] = $model->getMahasiswaOptions();
        $data['stafOptions'] = $model->getStafOptions();

        return view('hasilakhir/create', $data);
    }


    public function store()
    {
        $bobotpenilaian = $this->bobotpenilaian->getBobot();
        $bobot_ujianproposal = ($bobotpenilaian->bobot_ujianproposal) / 100;
        $bobot_seminarhasil = ($bobotpenilaian->bobot_seminarhasil) / 100;
        $bobot_ujianta = ($bobotpenilaian->bobot_ujianta) / 100;

        $nilai_ujianproposal = $nilai_ujianproposal * ($bobot_ujianproposal);
        $nilai_seminarhasil = $nilai_seminarhasil * ($bobot_seminarhasil);
        $nilai_ujianta = $nilai_ujianta * ($bobot_ujianta);

        $hasilakhir = $nilai_ujianproposal + $nilai_seminarhasil + $nilai_ujianta;

        $model = new SimtaHasilakhirModel();

        $data = [
            'id_ujianproposal' => $this->request->getVar('id_ujianproposal'),
            'id_seminarhasil' => $this->request->getVar('id_seminarhasil'),
            'id_ujianta' => $this->request->getVar('id_ujianta'),
            'id_mhs' => $this->request->getVar('id_mhs'),
            'id_staf' => $this->request->getVar('id_staf'),
            'hasil_akhir' => $hasilakhir,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        

        $model->insert($data);

        return redirect()->to('/hasilakhir');
    }

    public function edit($id)
    {
        $model = new SimtaHasilakhirModel();
        
        $data['hasilakhir'] = $model->find($id);
        
        $data['ujianproposalOptions'] = $model->getUjianProposalOptions();
        $data['seminarhasilOptions'] = $model->getSeminarHasilOptions();
        $data['ujiantaOptions'] = $model->getUjianTaOptions();
        $data['mahasiswaOptions'] = $model->getMahasiswaOptions();
        $data['stafOptions'] = $model->getStafOptions();

        return view('hasilakhir/edit', $data);
    }

    public function update()
    {
        $model = new SimtaHasilakhirModel();

        $id = $this->request->getVar('id_hasilakhir');

        $data = [
            'id_ujianproposal' => $this->request->getVar('id_ujianproposal'),
            'id_seminarhasil' => $this->request->getVar('id_seminarhasil'),
            'id_ujianta' => $this->request->getVar('id_ujianta'),
            'id_mhs' => $this->request->getVar('id_mhs'),
            'id_staf' => $this->request->getVar('id_staf'),
            'hasil_akhir' => $this->request->getVar('hasil_akhir'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model->update($id, $data);

        return redirect()->to('/hasilakhir');
    }

    public function delete($id)
    {
        $model = new SimtaHasilakhirModel();

        $model->delete($id);

        return redirect()->to('/hasilakhir');
    }
}
