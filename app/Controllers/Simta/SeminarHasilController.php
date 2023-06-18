<?php

namespace App\Controllers\Simta;

use App\Controllers\BaseController;
use App\Models\Simta\SeminarHasilModel;
use App\Models\Master\MahasiswaModel;
use App\Models\Master\StafModel;
use Myth\Auth\Models\UserModel;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class SeminarHasilController extends BaseController
{
    public function __construct()
    {
        $this->seminarhasil = new SeminarHasilModel();
        $this->mahasiswa = new MahasiswaModel();
        $this->staf = new StafModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Seminar Hasil',
            'seminarhasil' => $this->seminarhasil->findAll(),
            'seminarhasil2' => $this->seminarhasil->getseminarhasilByUser(),
            'seminarhasil3' => $this->seminarhasil->getseminarhasilByUser1(),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'seminarhasil',
        ];
        return view('simta/seminarhasil/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Seminar Hasil',
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'seminarhasil',
            'validation' => $this->validation,
            
        ];

        return view('simta/seminarhasil/tambah', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $uuid = Uuid::uuid4();
        $id_seminarhasil = $uuid->toString();
        $id_mhs = $this->request->getVar('id_mhs');
        $id_staf = $this->request->getVar('id_staf');
        $nama_judul = $this->request->getVar('nama_judul');
        $abstrak = $this->request->getVar('abstrak');
        $jadwal_semhas = $this->request->getVar('jadwal_semhas');

        $rules = [
            'id_mhs' => [
                'label' => "Nama Mahasiswa",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                    'is_unique' => "{field} yang dimasukan Sudah ada",
                ],
            ],
            'id_staf' => [
                'label' => "Nama Dosen",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus dipilih",
                    'is_unique' => "{field} yang dimasukan Sudah ada",
                ],
            ],
            'nama_judul' => [
                'label' => "nama_judul",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                ],
            ],
            'abstrak' => [
                'label' => "abstrak",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                ],
            ],
            'jadwal_semhas' => [
                'label' => "jadwal_semhas",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $data = [
                'id_seminarhasil' => $uuid,
                'id_mhs' => $id_mhs,
                'id_staf' => $id_staf,
                'nama_judul' => $nama_judul,
                'abstrak' => $abstrak,
                'jadwal_semhas' => $jadwal_semhas,
            ];
            $this->seminarhasil->insert($data);
            session()->setFlashdata('success', 'Berhasil menambahkan Data Ujian Proposal');
            return redirect()->to(base_url('simta/seminarhasil'))->with('status_icon', 'success')->with('status_text', 'Berhasil menambahkan berkas');
        } else {
            return view('simta/seminarhasil/tambah', [
                'title' => 'Tambah Seminar Hasil',
                'mahasiswa' => $this->mahasiswa->findAll(),
                'staf' => $this->staf->findAll(),
                'activePage' => 'seminarhasil',
                'validation' => $this->validation,
            ]);
        }
    }

    public function edit($id_seminarhasil)
    {
        $data = [
            'title' => 'Edit Data Ujian Proposal ',
            'seminarhasil' => $this->seminarhasil->find($id_seminarhasil),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'seminarhasil',
            'validation' => $this->validation,
        ];
        return view('simta/seminarhasil/edit', $data);
    }
    public function update($id_seminarhasil)
    {
        $data = [
            $id_mhs = $this->request->getVar('id_mhs'),
            $id_staf = $this->request->getVar('id_staf'),
            $nama_judul = $this->request->getVar('nama_judul'),
            $abstrak = $this->request->getVar('abstrak'),
            $ruang_semhas = $this->request->getVar('ruang_semhas'),
            $jadwal_semhas = $this->request->getVar('jadwal_semhas'),
        ];
        //dd($data);
        $rules = [
            'id_mhs' => [
                'label' => "Nama Mahasiswa",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                    'is_unique' => "{field} yang dimasukan Sudah ada",
                ],
            ],
            'id_staf' => [
                'label' => "Nama Dosen",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus dipilih",
                    'is_unique' => "{field} yang dimasukan Sudah ada",
                ],
            ],
            'nama_judul' => [
                'label' => "nama_judul",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                ],
            ],
            'abstrak' => [
                'label' => "abstrak",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                ],
            ],
            'ruang_semhas' => [
                'label' => "ruang_semhas",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                ],
            ],
            'jadwal_semhas' => [
                'label' => "jadwal_semhas",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                ],
            ],
        ];
        // dd($rules);
        if ($this->validate($rules)) {
            $data = [
                'id_mhs' => $id_mhs,
                'id_staf' => $id_staf,
                'nama_judul' => $nama_judul,
                'abstrak' => $abstrak,
                'ruang_semhas' => $ruang_semhas,
                'jadwal_semhas' => $jadwal_semhas,
            ];
            // return dd($data);
            $this->seminarhasil->update($id_seminarhasil, $data);
            
            session()->setFlashdata('success', 'Data Pengajuan Judul berhasil ditambahkan');
            return redirect()->to('simta/seminarhasil')->with('status_icon', 'success')->with('status_text', 'Data Berhasil ditambah');
                $this->seminarhasil->update($id_seminarhasil, $data2);
                return redirect()->to('simta/seminarhasil')->with('status', 'Data berhasil diubah');
        } else {
            return view('simta/seminarhasil/edit', [
                'title' => 'Edit Data Ujian Proposal ',
                'seminarhasil' => $this->seminarhasil->find($id_seminarhasil),
                'mahasiswa' => $this->mahasiswa->findAll(),
                'staf' => $this->staf->findAll(),
                'activePage' => 'seminarhasil',
                'validation' => $this->validation,
            ]);
        }
    }

    public function editstatus($id_seminarhasil)
    {
        $data = [
            'title' => 'Edit Data Penilaian Seminar Hasil',
            'seminarhasil' => $this->seminarhasil->find($id_seminarhasil),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'seminarhasil',
            'validation' => $this->validation,
        ];
        return view('simta/seminarhasil/editstatus', $data);
    }

    public function updatestatus($id_seminarhasil)
    {
        $data = [
            $nilai_total = $this->request->getVar('nilai_total'),
            $status_sh = $this->request->getVar('status_sh'),
            $catatan = $this->request->getVar('catatan'),
        ];
        // dd($data);
        
        $rules = [
            'nilai_total' => [
                'label' => "Nilai Total",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                    'is_unique' => "{field} yang dimasukan Sudah ada",
                ],
            ],
            'status_sh' => [
                'label' => "Status",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus dipilih",
                    'is_unique' => "{field} yang dimasukan Sudah ada",
                ],
            ],
            'catatan' => [
                'label' => "Catatan",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                    'is_unique' => "{field} yang dimasukan Sudah ada",
                ],
            ],
            
            
        ];
        // dd($rules);
        if ($this->validate($rules)) {
        $data = [
            'nilai_total' => $nilai_total,
            'status_sh' => $status_sh,
            'catatan' => $catatan,
        ];

        $this->seminarhasil->update($id_seminarhasil, $data);

        session()->setFlashdata('success', 'Data Seminar Hasil berhasil diupdate');
        return redirect()->to('simta/seminarhasil')->with('status_icon', 'success')->with('status_text', 'Data Berhasil diedit');

    } else {
        return view('simta/seminarhasil/editstatus', [
            'title' => 'Edit Data Penilaian Seminar Hasil',
            'seminarhasil' => $this->seminarhasil->find($id_seminarhasil),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'seminarhasil',
            'validation' => $this->validation,
        ]);
    }
}
    public function delete($id_seminarhasil)
    {
        $data = $this->seminarhasil->find($id_seminarhasil);
        $this->seminarhasil->delete($id_seminarhasil);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('simta/seminarhasil');
    }

    public function download_link_file($id_seminarhasil)
    {
        $seminarhasil = $this->seminarhasil->find($id_seminarhasil);       
        return $this->response->download('simta_assets/link_file/' . $seminarhasil->link_file, null);
    }

    public function detail($id_seminarhasil)
    {
        $data = [
            'title' => 'Detail Data Seminar Hasil ',
            'seminarhasil' => $this->seminarhasil->find($id_seminarhasil),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'seminarhasil',
            'validation' => $this->validation,
        ];
        return view('simta/seminarhasil/detail', $data);
    }
}
?>