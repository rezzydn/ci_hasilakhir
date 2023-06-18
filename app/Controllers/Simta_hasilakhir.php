<?php

namespace App\Controllers;

use App\Models\Simta_hasilakhir_model;
use CodeIgniter\Controller;

class Simta_hasilakhir extends Controller
{
    public function index()
    {
        $model = new Simta_hasilakhir_model();
        $data['hasilakhir'] = $model->findAll();

        return view('simta_hasilakhir/index', $data);
    }

    public function create()
    {
        return view('simta_hasilakhir/create');
    }

    public function store()
    {
        $model = new Simta_hasilakhir_model();
        $data = [
            'id_ujianproposal' => $this->request->getPost('id_ujianproposal'),
            'id_seminarhasil' => $this->request->getPost('id_seminarhasil'),
            'id_ujianta' => $this->request->getPost('id_ujianta'),
            'id_mhs' => $this->request->getPost('id_mhs'),
            'id_staf' => $this->request->getPost('id_staf'),
            'hasil_akhir' => $this->request->getPost('hasil_akhir'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model->insert($data);

        return redirect()->to('/simta_hasilakhir');
    }

    public function edit($id)
    {
        $model = new Simta_hasilakhir_model();
        $data['hasilakhir'] = $model->find($id);

        return view('simta_hasilakhir/edit', $data);
    }

    public function update($id)
    {
        $model = new Simta_hasilakhir_model();
        $data = [
            'id_ujianproposal' => $this->request->getPost('id_ujianproposal'),
            'id_seminarhasil' => $this->request->getPost('id_seminarhasil'),
            'id_ujianta' => $this->request->getPost('id_ujianta'),
            'id_mhs' => $this->request->getPost('id_mhs'),
            'id_staf' => $this->request->getPost('id_staf'),
            'hasil_akhir' => $this->request->getPost('hasil_akhir'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model->update($id, $data);

        return redirect()->to('/simta_hasilakhir');
    }

    public function delete($id)
    {
        $model = new Simta_hasilakhir_model();
        $model->delete($id);

        return redirect()->to('/simta_hasilakhir');
    }
}
