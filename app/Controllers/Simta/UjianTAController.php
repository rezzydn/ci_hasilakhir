<?php

namespace App\Controllers\Simta;

use App\Controllers\BaseController;
use App\Models\Simta\UjianTAModel;
use App\Models\Master\MahasiswaModel;
use App\Models\Master\StafModel;
use App\Models\Simta\PengujiUjianTAModel;
use Myth\Auth\Models\UserModel;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class UjianTAController extends BaseController
{
    public function __construct()
    {
        $this->ujianta = new UjianTAModel();
        $this->mahasiswa = new MahasiswaModel();
        $this->staf = new StafModel();
        $this->pengujiujianta = new PengujiUjianTAModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Ujian Tugas Akhir',
            'ujianta' => $this->ujianta->findAll(),
            'ujianta2' => $this->ujianta->getujiantaByUser(),
            'ujianta3' => $this->ujianta->getujiantaByUser1(),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'ujianta',
        ];
        return view('simta/ujianta/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Ujian Tugas Akhir',
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'ujianta',
            'validation' => $this->validation,
            
        ];

        return view('simta/ujianta/tambah', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $uuid = Uuid::uuid4();
        $id_ujianta = $uuid->toString();
        $id_mhs = $this->request->getVar('id_mhs');
        $id_staf = $this->request->getVar('id_staf');
        $nama_judul = $this->request->getVar('nama_judul');
        $abstrak = $this->request->getVar('abstrak');
        $tanggal = $this->request->getVar('tanggal');
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
        ];

        if ($this->validate($rules)) {
            $data = [
                'id_ujianta' => $uuid,
                'id_mhs' => $id_mhs,
                'id_staf' => $id_staf,
                'nama_judul' => $nama_judul,
                'abstrak' => $abstrak,
                'tanggal' => $tanggal,
                'created_at' => $created_at,
            ];
            // dd($data);
            $this->ujianta->insert($data);
            $proposalakhir->move('simta_assets/proposalakhir/', $proposalakhirName);
            session()->setFlashdata('success', 'Berhasil menambahkan Data Ujian Tugas Akhir');
            return redirect()->to(base_url('simta/ujianta'))->with('status_icon', 'success')->with('status_text', 'Berhasil menambahkan berkas');
        } else {
            return view('simta/ujianta/tambah', [
                'title' => 'Tambah ujianta',
                'activePage' => 'ujianta',
                'validation' => $this->validation,
            ]);
        }
    }

    public function edit($id_ujianta)
    {
        $data = [
            'title' => 'Revisi Proposal Ujian Tugas Akhir ',
            'ujianta' => $this->ujianta->find($id_ujianta),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'ujianta',
            'validation' => $this->validation,
        ];
        return view('simta/ujianta/edit', $data);
    }
    public function update($id_ujianta)
    {
        $data = [
            $id_mhs = $this->request->getVar('id_mhs'),
            $id_staf = $this->request->getVar('id_staf'),
            $nama_judul = $this->request->getVar('nama_judul'),
            $abstrak = $this->request->getVar('abstrak'),
            $ruangan = $this->request->getVar('ruangan'),
            $tanggal = $this->request->getVar('tanggal'),
            $updated_at = round(microtime(true) * 1000),
        ];
        // dd($data);
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
            'ruangan' => [
                'label' => "ruangan",
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
        
        if ($this->validate($rules)) {
            $data = [
                'id_mhs' => $id_mhs,
                'id_staf' => $id_staf,
                'nama_judul' => $nama_judul,
                'abstrak' => $abstrak,
                'ruangan' => $ruangan,
                'tanggal' => $tanggal,
                'updated_at' => $updated_at,
            ];
    
            $this->ujianta->update($id_ujianta, $data);
    
            session()->setFlashdata('success', 'Data Ujian ta berhasil diupdate');
            return redirect()->to('simta/ujianta')->with('status_icon', 'success')->with('status_text', 'Data Berhasil diedit');
    
        } else {
            return view('simta/ujianta/editstatus', [
                'title' => 'Edit Data Penilaian Ujian ta',
                'ujianta' => $this->ujianta->find($id_ujianta),
                'mahasiswa' => $this->mahasiswa->findAll(),
                'staf' => $this->staf->findAll(),
                'activePage' => 'ujianta',
                'validation' => $this->validation,
            ]);
        }
    }

    public function editstatus($id_ujianta)
    {
        $data = [
            'title' => 'Edit Data Penilaian Ujian ta',
            'ujianta' => $this->ujianta->find($id_ujianta),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'ujianta',
            'validation' => $this->validation,
        ];
        return view('simta/ujianta/editstatus', $data);
    }

    public function updatestatus($id_ujianta)
    {
        $nilai_ut = $this->request->getVar('nilai_ut');
        $status_ut = $this->request->getVar('status_ut');
        $catatan = $this->request->getVar('catatan');
        $updated_at = round(microtime(true) * 1000);
        
        $rules = [
            'nilai_ut' => [
                'label' => "nilai_ut",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                    'is_unique' => "{field} yang dimasukan Sudah ada",
                ],
            ],
            'status_ut' => [
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

        if ($this->validate($rules)) {
        $data = [
            'nilai_ut' => $nilai_ut,
            'status_ut' => $status_ut,
            'catatan' => $catatan,
            'updated_at' => $updated_at,
        ];
        // dd($data);
        $this->ujianta->update($id_ujianta, $data);
        // dd($data);
        session()->setFlashdata('success', 'Data Ujian ta berhasil diupdate');
        return redirect()->to('simta/ujianta')->with('status_icon', 'success')->with('status_text', 'Data Berhasil diedit');

    } else {
        return view('simta/ujianta/editstatus', [
            'title' => 'Edit Data Penilaian Ujian ta',
            'ujianta' => $this->ujianta->find($id_ujianta),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'ujianta',
            'validation' => $this->validation,
        ]);
    }
    }

    public function delete($id_ujianta)
    {
        $data = $this->ujianta->find($id_ujianta);
        $this->ujianta->delete($id_ujianta);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('simta/ujianta');
    }

    public function download_proposalakhir($id_ujianta)
    {
        $ujianta = $this->ujianta->find($id_ujianta);       
        return $this->response->download('simta_assets/proposalakhir/' . $ujianta->proposalakhir, null);
        //dd($ujianta);
    }

    public function detail($id_ujianta)
    {
        $data = [
            'title' => 'Detail Data Ujian Tugas Akhir ',
            'ujianta' => $this->ujianta->find($id_ujianta),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'pengujiujianta' => $this->pengujiujianta->getDataByIdUjianTA($id_ujianta),
            'activePage' => 'ujianta',
            'validation' => $this->validation,
        ];
        return view('simta/ujianta/detail', $data);
    }

    public function penilaian()
    {
        $faker = \Faker\Factory::create('id_ujinta');
        for ($i = 0; $i < 100; $i++) {
            $ujianta[] = [
                'nama_judul' => $faker->nama_judul(),
                'abstak' => $faker->abstak(),
                'ruangan' => $faker->ruangan(),
                'tanggal' => $faker->tanggal(),
            ];
        }
        $data['ujianta'] = $ujianta;
        return view('penilaian', $data);
    }
    public function editpenguji($id_ujianta)
    {
        $data = [
            'title' => 'Edit Data Dosen Penguji Ujian Tugas Akhir',
            'ujianta' => $this->ujianta->find($id_ujianta),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'ujianta',
            'validation' => $this->validation,
        ];
        return view('simta/ujianta/editpenguji', $data);
    }

    public function tambahpengujiujianta($id_ujianta)
    {
        $data = [
            'title' => 'Tambah Data Dosen Penguji  Tugas Akhir',
            'ujianta' => $this->ujianta->find($id_ujianta),
            'staf' => $this->staf->findAll(),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'pengujiujianta' => $this->pengujiujianta->findAll(),
            'activePage' => 'pengujiujianta',
            'validation' => $this->validation,

        ];

        return view('simta/ujianta/tambahpengujiujianta', $data);
    }
    public function storepengujiujianta($id_ujianta)
    {
        $uuid = Uuid::uuid4();
        $id_penguji_ujianta = $uuid->toString();
        $id_ujianta = $this->request->getVar('id_ujianta');
        $id_staf = $this->request->getVar('id_staf');
        $nama_penguji = $this->request->getVar('nama_penguji');
        $created_at = round(microtime(true) * 1000);

        $rules = [
            'id_ujianta' => [
                'label' => "Nama Ujian ta",
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
                'id_penguji_ujianta' => $uuid,
                'id_ujianta' => $id_ujianta,
                'id_staf' => $id_staf,
                'nama_penguji' => $nama_penguji,
                'created_at' => $created_at,
            ];
            //return dd($data);
            $this->pengujiujianta->insert($data);

            session()->setFlashdata('success', 'Data Dosen Penguji berhasil ditambahkan');
            return redirect()->to('simta/ujianta')->with('status_icon', 'success')->with('status_text', 'Data Berhasil ditambah');
        } else {
            return view('simta/ujianta/tambahpengujiujianta', [
                'title' => 'Tambah Data Dosen Penguji',
                'ujianta' => $this->ujianta->find($id_ujianta),
                'mahasiswa' => $this->mahasiswa->findAll(),
                'staf' => $this->staf->findAll(),
                'pengujiujianta' => $this->pengujiujianta->findAll(),
                'activePage' => 'pengujiujianta',
                'validation' => $this->validation,
            ]);
        }
    }

    public function editpengujiujianta($id_penguji_ujianta)
    {
        $data = [
            'title' => 'Edit Data Dosen Penguji Tugas Akhir ',
            'pengujiujianta' => $this->pengujiujianta->find($id_penguji_ujianta),
            'mahasiswa' => $this->mahasiswa->findAll(),
            'staf' => $this->staf->findAll(),
            'activePage' => 'pengujiujianta',
            'validation' => $this->validation,
        ];
        return view('simta/ujianta/editpengujiujianta', $data);
    }

    public function updatepengujiujianta($id_penguji_ujianta)
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
            $this->pengujiujianta->update($id_penguji_ujianta, $data);
            //dd($data);
            session()->setFlashdata('success', 'Data Dosen Penguji berhasil diupdate');
            return redirect()->to('simta/ujianta')->with('status_icon', 'success')->with('status_text', 'Data Berhasil diedit');

        } else {
            return view('simta/ujianta/editpengujiujianta', [
                'title' => 'Edit Data Dosen Penguji',
                'pengujiujianta' => $this->pengujiujianta->find($id_penguji_ujianta),
                'mahasiswa' => $this->mahasiswa->findAll(),
                'staf' => $this->staf->findAll(),
                'activePage' => 'pengujiujianta',
                'validation' => $this->validation,
            ]);
        }
    }

    public function deletepengujiujianta($id_penguji_ujianta)
    {
        $data = $this->pengujiujianta->find($id_penguji_ujianta);
        $this->pengujiujianta->delete($id_penguji_ujianta);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('simta/ujianta');
    }
}
?>