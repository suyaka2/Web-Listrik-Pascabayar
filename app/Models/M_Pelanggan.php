<?php
namespace App\Models;
use CodeIgniter\Model;
 
class M_Pelanggan extends Model
{
    protected $table = 'pelanggan';
 
    public function getDataPelanggan($where = false)
{
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('nama_pelanggan','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('nama_pelanggan','ASC');
            return $query = $builder->get();
        }
    }

    public function getDataPelangganJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('tarif','tarif.id_tarif = pelanggan.id_tarif','LEFT');
            
            
            $builder->orderBy('pelanggan.nama_pelanggan','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tarif','tarif.id_tarif = pelanggan.id_tarif','LEFT');
            $builder->orderBy('pelanggan.nama_pelanggan','ASC');
            return $query = $builder->get();
        }
    }


    
    public function saveDataPelanggan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateDataPelanggan($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }
    
    public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_pelanggan");
        $builder->orderBy("id_pelanggan", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}

    public function deleteDataPelanggan($id_pelanggan)
    {
        // Perintah ini akan menjalankan: DELETE FROM tarif WHERE id_tarif = ...
        // Data akan hilang selamanya.
        return $this->delete($id_pelanggan);
    }
}
?>