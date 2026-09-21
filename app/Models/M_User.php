<?php
namespace App\Models;
use CodeIgniter\Model;
 
class M_User extends Model
{
    protected $table = 'user';
 
    public function getDataUser($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('nama_admin','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('nama_admin','ASC');
            return $query = $builder->get();
        }
    }

    // Di dalam file M_User.php
public function getDataUserJoin($where = false)
{
    if ($where === false) {
        $builder = $this->db->table($this->table);
        
        // Pilih kolom secara spesifik untuk menghindari konflik nama kolom
        $builder->select('
            user.id_user,
            user.username,
            user.password,
            user.nama_admin,
            user.id_level,
            level.nama_level
        ');
        
        // Cukup join dengan tabel 'level', karena hanya itu yang dibutuhkan
        $builder->join('level', 'level.id_level = user.id_level', 'LEFT');
        
        $builder->orderBy('user.id_user', 'ASC');
        return $query = $builder->get();

    } else {
        $builder = $this->db->table($this->table);

        // Pilih kolom secara spesifik untuk menghindari konflik nama kolom
        $builder->select('
            user.id_user,
            user.username,
            user.password,
            user.nama_admin,
            user.id_level,
            level.nama_level
        ');

        // Terapkan kondisi 'where'
        $builder->where($where);
        
        // Cukup join dengan tabel 'level', karena hanya itu yang dibutuhkan
        $builder->join('level', 'level.id_level = user.id_level', 'LEFT');
        
        $builder->orderBy('user.id_user', 'ASC');
        return $query = $builder->get();
    }
}
    
    public function saveDataUser($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateDataUser($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }
    
    public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_user");
        $builder->orderBy("id_user", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}
}
?>