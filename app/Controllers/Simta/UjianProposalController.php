<?php

namespace App\Controllers\Simta;

use App\Controllers\BaseController;
use App\Models\Master\MahasiswaModel;
use App\Models\Master\StafModel;
use App\Models\Simta\PengujiUjianProposalModel;
use App\Models\Simta\UjianProposalModel;
use Ramsey\Uuid\Uuid;

class UjianProposalController extends BaseController
{
    public function __construct()
    {
        $this->ujianproposal = new UjianProposalModel();
        $this->pengujiujianproposal = new PengujiUjianProposalModel();
        $this->mahasiswa = new MahasiswaModel();
        $this->staf = new StafModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Ujian Proposal',
            'ujianproposal' => $this->ujianproposal->findAll(),
            'ujianproposal2' => $this->ujianproposal->getujianproposalByUser(),
            'ujianproposal3' => $this->ujianproposal->getujianproposalByUser1(),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'ujianproposal',
        ];
        return view('simta/ujianproposal/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Ujian Proposal',
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'ujianproposal',
            'validation' => $this->validation,

        ];

        return view('simta/ujianproposal/tambah', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $uuid = Uuid::uuid4();
        $id_ujianproposal = $uuid->toString();
        $id_mhs = $this->request->getVar('id_mhs');
        $id_staf = $this->request->getVar('id_staf');
        $nama_judul = $this->request->getVar('nama_judul');
        $abstrak = $this->request->getVar('abstrak');
        $tanggal = $this->request->getVar('tanggal');
        $proposalawal = $this->request->getFile('proposalawal');
        $proposalawalName = $proposalawal->getRandomName();
        $created_at = round(microtime(true) * 1000);

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
            'tanggal' => [
                'label' => "tanggal",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                ],
            ],
            'proposalawal' => [
                'rules' => "uploaded[proposalawal]|ext_in[proposalawal,pdf]|max_size[proposalawal,2048]",
                'errors' => [
                    'uploaded' => 'File harus diupload',
                    'ext_in' => 'File berupa pdf',
                    'max_size' => 'Size maks 5 MB',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $data = [
                'id_ujianproposal' => $uuid,
                'id_mhs' => $id_mhs,
                'id_staf' => $id_staf,
                'nama_judul' => $nama_judul,
                'abstrak' => $abstrak,
                'tanggal' => $tanggal,
                'proposalawal' => $proposalawalName,
                'created_at' => $created_at,
            ];
            $this->ujianproposal->insert($data);
            $proposalawal->move('simta_assets/proposalawal/', $proposalawalName);
            session()->setFlashdata('success', 'Berhasil menambahkan Data Ujian Proposal');
            return redirect()->to(base_url('simta/ujianproposal'))->with('status_icon', 'success')->with('status_text', 'Berhasil menambahkan berkas');
        } else {
            return view('simta/ujianproposal/tambah', [
                'title' => 'Tambah ujianproposal',
                'activePage' => 'ujianproposal',
                'validation' => $this->validation,
            ]);
        }
    }

    public function edit($id_ujianproposal)
    {
        $data = [
            'title' => 'Edit Data Ujian Proposal ',
            'ujianproposal' => $this->ujianproposal->find($id_ujianproposal),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'ujianproposal',
            'validation' => $this->validation,
        ];
        return view('simta/ujianproposal/edit', $data);
    }
    public function update($id_ujianproposal)
    {
        $data = [
            $id_mhs = $this->request->getVar('id_mhs'),
            $id_staf = $this->request->getVar('id_staf'),
            $nama_judul = $this->request->getVar('nama_judul'),
            $abstrak = $this->request->getVar('abstrak'),
            $ruang_sempro = $this->request->getVar('ruang_sempro'),
            $tanggal = $this->request->getVar('tanggal'),
            $updated_at = round(microtime(true) * 1000),
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
            'ruang_sempro' => [
                'label' => "ruang_sempro",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                ],
            ],
            'tanggal' => [
                'label' => "tanggal",
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
                'ruang_sempro' => $ruang_sempro,
                'tanggal' => $tanggal,
                'created_at' => $created_at,
            ];
            // return dd($data);
            $this->ujianproposal->update($id_ujianproposal, $data);

            session()->setFlashdata('success', 'Data Ujian Proposal berhasil ditambahkan');
            return redirect()->to('simta/ujianproposal')->with('status_icon', 'success')->with('status_text', 'Data Berhasil ditambah');
            $this->ujianproposal->update($id_ujianproposal, $data2);
            return redirect()->to('simta/ujianproposal')->with('status', 'Data berhasil diubah');
        } else {
            return view('simta/ujianproposal/edit', [
                'title' => 'Edit Data Ujian Proposal ',
                'ujianproposal' => $this->ujianproposal->find($id_ujianproposal),
                'mahasiswa' => $this->mahasiswa->findAll(),
                'staf' => $this->staf->findAll(),
                'activePage' => 'ujianproposal',
                'validation' => $this->validation,
            ]);
        }
    }

    public function editstatus($id_ujianproposal)
    {
        $data = [
            'title' => 'Edit Data Penilaian Ujian Proposal',
            'ujianproposal' => $this->ujianproposal->find($id_ujianproposal),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'ujianproposal',
            'validation' => $this->validation,
        ];
        return view('simta/ujianproposal/editstatus', $data);
    }

    public function updatestatus($id_ujianproposal)
    {
        $data = [
            $nilai_up = $this->request->getVar('nilai_up'),
            $status_up = $this->request->getVar('status_up'),
            $catatan = $this->request->getVar('catatan'),
            $updated_at = round(microtime(true) * 1000),
        ];
        // dd($data);

        $rules = [
            'nilai_up' => [
                'label' => "nilai_up",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                    'is_unique' => "{field} yang dimasukan Sudah ada",
                ],
            ],
            'status_up' => [
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
                'nilai_up' => $nilai_up,
                'status_up' => $status_up,
                'catatan' => $catatan,
                'updated_at' => $updated_at,
            ];

            $this->ujianproposal->update($id_ujianproposal, $data);

            session()->setFlashdata('success', 'Data Ujian Proposal berhasil diupdate');
            return redirect()->to('simta/ujianproposal')->with('status_icon', 'success')->with('status_text', 'Data Berhasil diedit');

        } else {
            return view('simta/ujianproposal/editstatus', [
                'title' => 'Edit Data Penilaian Ujian Proposal',
                'ujianproposal' => $this->ujianproposal->find($id_ujianproposal),
                'mahasiswa' => $this->mahasiswa->findAll(),
                'staf' => $this->staf->findAll(),
                'activePage' => 'ujianproposal',
                'validation' => $this->validation,
            ]);
        }
    }

    public function delete($id_ujianproposal)
    {
        $data = $this->ujianproposal->find($id_ujianproposal);
        $this->ujianproposal->delete($id_ujianproposal);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('simta/ujianproposal');
    }

    public function download_proposalawal($id_ujianproposal)
    {
        $ujianproposal = $this->ujianproposal->find($id_ujianproposal);
        return $this->response->download('simta_assets/proposalawal/' . $ujianproposal->proposalawal, null);
    }

    public function detail($id_ujianproposal)
    {
        $data = [
            'title' => 'Detail Data Ujian Proposal ',
            'ujianproposal' => $this->ujianproposal->find($id_ujianproposal),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'pengujiujianproposal' => $this->pengujiujianproposal->getDataByIdUjianProposal($id_ujianproposal),
            'activePage' => 'ujianproposal',
            'validation' => $this->validation,
        ];
        return view('simta/ujianproposal/detail', $data);
    }

    public function editpelaksanaan($id_ujianproposal)
    {
        $data = [
            'title' => 'Edit Data Dosen Penguji Ujian Proposal',
            'ujianproposal' => $this->ujianproposal->find($id_ujianproposal),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'ujianproposal',
            'validation' => $this->validation,
        ];
        return view('simta/ujianproposal/editpenguji', $data);
    }

    public function tambahpengujiujianproposal($id_ujianproposal)
    {
        $data = [
            'title' => 'Tambah Data Dosen Penguji  Tugas Akhir',
            'ujianproposal' => $this->ujianproposal->find($id_ujianproposal),
            'staf' => $this->staf->findAll(),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'pengujiujianproposal' => $this->pengujiujianproposal->findAll(),
            'activePage' => 'pengujiujianproposal',
            'validation' => $this->validation,

        ];

        return view('simta/ujianproposal/tambahpengujiujianproposal', $data);
    }
    public function storepengujiujianproposal($id_ujianproposal)
    {
        $uuid = Uuid::uuid4();
        $id_penguji_ujianproposal = $uuid->toString();
        $id_ujianproposal = $this->request->getVar('id_ujianproposal');
        $id_staf = $this->request->getVar('id_staf');
        $nama_penguji = $this->request->getVar('nama_penguji');
        $created_at = round(microtime(true) * 1000);

        $rules = [
            'id_ujianproposal' => [
                'label' => "Nama Ujian Proposal",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus dipilih",
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
            'nama_penguji' => [
                'label' => "Nama penguji Dosen",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus dipilih",
                    'is_unique' => "{field} yang dimasukan Sudah ada",
                ],
            ],

        ];

        if ($this->validate($rules)) {
            $data = [
                'id_penguji_ujianproposal' => $uuid,
                'id_ujianproposal' => $id_ujianproposal,
                'id_staf' => $id_staf,
                'nama_penguji' => $nama_penguji,
                'created_at' => $created_at,
            ];
            //return dd($data);
            $this->pengujiujianproposal->insert($data);

            session()->setFlashdata('success', 'Data Dosen Penguji berhasil ditambahkan');
            return redirect()->to('simta/ujianproposal')->with('status_icon', 'success')->with('status_text', 'Data Berhasil ditambah');
        } else {
            return view('simta/ujianproposal/tambahpengujiujianproposal', [
                'title' => 'Tambah Data Dosen Penguji',
                'ujianproposal' => $this->ujianproposal->find($id_ujianproposal),
                'mahasiswa' => $this->mahasiswa->findAll(),
                'staf' => $this->staf->findAll(),
                'pengujiujianproposal' => $this->pengujiujianproposal->findAll(),
                'activePage' => 'pengujiujianproposal',
                'validation' => $this->validation,
            ]);
        }
    }

    public function editpengujiujianproposal($id_penguji_ujianproposal)
    {
        $data = [
            'title' => 'Edit Data Dosen Penguji Tugas Akhir ',
            'pengujiujianproposal' => $this->pengujiujianproposal->find($id_penguji_ujianproposal),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'pengujiujianproposal',
            'validation' => $this->validation,
        ];
        return view('simta/ujianproposal/editpengujiujianproposal', $data);
    }

    public function updatepengujiujianproposal($id_penguji_ujianproposal)
    {
        $nama_penguji = $this->request->getVar('nama_penguji');
        $id_staf = $this->request->getVar('id_staf');
        $updated_at = round(microtime(true) * 1000);

        $rules = [
            'nama_penguji' => [
                'label' => "Nama Penguji",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus dipilih",
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
        ];

        if ($this->validate($rules)) {
            $data = [
                'id_staf' => $id_staf,
                'nama_penguji' => $nama_penguji,
                'updated_at' => $updated_at,
            ];
            //dd($data);
            $this->pengujiujianproposal->update($id_penguji_ujianproposal, $data);
            //dd($data);
            session()->setFlashdata('success', 'Data Dosen Penguji berhasil diupdate');
            return redirect()->to('simta/ujianproposal')->with('status_icon', 'success')->with('status_text', 'Data Berhasil diedit');

        } else {
            return view('simta/ujianproposal/editpengujiujianproposal', [
                'title' => 'Edit Data Dosen Penguji',
                'pengujiujianproposal' => $this->pengujiujianproposal->find($id_penguji_ujianproposal),
                'mahasiswa' => $this->mahasiswa->findAll(),
                'staf' => $this->staf->findAll(),
                'activePage' => 'pengujiujianproposal',
                'validation' => $this->validation,
            ]);
        }
    }

    public function deletepengujiujianproposal($id_penguji_ujianproposal)
    {
        $data = $this->pengujiujianproposal->find($id_penguji_ujianproposal);
        $this->pengujiujianproposal->delete($id_penguji_ujianproposal);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('simta/ujianproposal');
    }
}
