<?php

namespace Myth\Auth\Models;

use CodeIgniter\Model;
use Faker\Generator;
use Myth\Auth\Authorization\GroupModel;
use Myth\Auth\Entities\User;

/**
 * @method User|null first()
 */
class UserModel extends Model
{
    protected $table          = 'users';
    protected $primaryKey     = 'id';
    protected $returnType     = User::class;
    // protected $useSoftDeletes = true;
    protected $allowedFields  = [
        'email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at',
    ];
    protected $useTimestamps   = true;
    protected $validationRules = [
        'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
        'username'      => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        'password_hash' => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    protected $afterInsert        = ['addToGroup'];

    /**
     * The id of a group to assign.
     * Set internally by withGroup.
     *
     * @var int|null
     */
    protected $assignGroup;

    /**
     * Logs a password reset attempt for posterity sake.
     */
    public function logResetAttempt(string $email, ?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
    {
        $this->db->table('auth_reset_attempts')->insert([
            'email'      => $email,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token'      => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Logs an activation attempt for posterity sake.
     */
    public function logActivationAttempt(?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
    {
        $this->db->table('auth_activation_attempts')->insert([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token'      => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Sets the group to assign any users created.
     *
     * @return $this
     */
    public function withGroup(string $groupName)
    {
        $group = $this->db->table('auth_groups')->where('name', $groupName)->get()->getFirstRow();

        $this->assignGroup = $group->id;

        return $this;
    }

    /**
     * Clears the group to assign to newly created users.
     *
     * @return $this
     */
    public function clearGroup()
    {
        $this->assignGroup = null;

        return $this;
    }

    /**
     * If a default role is assigned in Config\Auth, will
     * add this user to that group. Will do nothing
     * if the group cannot be found.
     *
     * @param mixed $data
     *
     * @return mixed
     */
    protected function addToGroup($data)
    {
        if (is_numeric($this->assignGroup)) {
            $groupModel = model(GroupModel::class);
            $groupModel->addUserToGroup($data['id'], $this->assignGroup);
        }

        return $data;
    }

    /* Mengambil relasi antara tabel 'users' dengan 'auth_groups' */
    function getRelationRole(){
        $builder = $this->db->table('users');
        $builder->select('auth_groups.id, auth_groups.name');
        $builder->join('auth_groups_users','auth_groups_users.user_id = users.id');
        $builder->join('auth_groups','auth_groups.id = auth_groups_users.group_id');
        $builder->groupBy('auth_groups.id');
        /* Menjalankan query */
        $query = $builder->get();
        /* Mengembalikan hasil query */
        return $query->getResult();  
    }

    function getRelationRoleMahasiswa(){
        $builder = $this->db->table('users');
        $builder->select('auth_groups.id, auth_groups.name');
        $builder->join('auth_groups_users','auth_groups_users.user_id = users.id');
        $builder->join('auth_groups','auth_groups.id = auth_groups_users.group_id');
        $builder->groupBy('auth_groups.id');
        $builder->join('mahasiswa','mahasiswa.id_mhs = auth_groups_users.user_id');
        $builder->where(['mahasiswa.id_user' => $user_id]);
        $query = $builder->get();
        return $query->getResult(); 
    }

    function getRelationRoleMitra(){
        $builder = $this->db->table('users');
        $builder->select('auth_groups.id, auth_groups.name');
        $builder->join('auth_groups_users','auth_groups_users.user_id = users.id');
        $builder->join('auth_groups','auth_groups.id = auth_groups_users.group_id');
        $builder->groupBy('auth_groups.id');
        $builder->join('mitra','mitra.id_mitra = auth_groups_users.user_id');
        $builder->where(['mitra.id_user' => $user_id]);
        $query = $builder->get();
        return $query->getResult(); 
    }

    public function getUsers()
    {
        return $this->select('users.id, users.email, users.username, users.active, gs.group_id, g.name AS group_name, m.id_mhs, m.nama AS mahasiswa_nama, m.nim, m.prodi, m.no_telp AS mahasiswa_no_telp, m.th_masuk, m.th_lulus, m.kelas, m.status, s.id_staf, s.nama AS staf_nama, s.nip, s.no_telp AS staf_no_telp, s.alamat, s.jenis AS staf_jenis, s.status AS staf_status, mt.id_mitra, mt.nama_instansi, mt.nama_pimpinan, mt.nama_mentor, mt.alamat AS mitra_alamat, mt.no_telp AS mitra_no_telp, mt.created_at, mt.updated_at')
            ->join('auth_groups_users gs', 'users.id = gs.user_id')
            ->join('auth_groups g', 'g.id = gs.group_id')
            ->join('mahasiswa m', 'm.id_user = users.id', 'left')
            ->join('staf s', 's.id_user = users.id', 'left') 
            ->join('mitra mt', 'mt.id_user = users.id', 'left') 
            ->findAll();
    }
    

    
    /**
     * Faked data for Fabricator.
     */
    public function fake(Generator &$faker): User
    {
        return new User([
            'email'    => $faker->email,
            'username' => $faker->userName,
            'password' => bin2hex(random_bytes(16)),
        ]);
    }
}