<?php
namespace App\Models;
use CodeIgniter\Model;
 
class M_Penggunaan extends Model
{
    protected $table = 'penggunaan';
 
    public function getDataPenggunaan($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('bulan','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('bulan','ASC');
            return $query = $builder->get();
        }
    }

    public function getDataPenggunaanJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            // $builder->select('*');
            $builder->select('penggunaan.*, pelanggan.nama_pelanggan, pelanggan.alamat, tagihan.id_tagihan, tagihan.jumlah_meter, tagihan.status');
            $builder->join('pelanggan','pelanggan.id_pelanggan = penggunaan.id_pelanggan','LEFT');
            $builder->join('tagihan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan', 'left');
            $builder->orderBy('penggunaan.bulan','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('penggunaan.*, pelanggan.nama_pelanggan, pelanggan.alamat, tagihan.id_tagihan, tagihan.jumlah_meter, tagihan.status');
            
            // $builder->select('*');
            $builder->where($where);
            $builder->join('tagihan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan', 'left');
            $builder->join('pelanggan','pelanggan.id_pelanggan = penggunaan.id_pelanggan','LEFT');
            $builder->orderBy('penggunaan.bulan','ASC');
            return $query = $builder->get();
        }
    }

    // Di dalam file M_Pelanggan.php

    
    public function saveDataPenggunaan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateDataPenggunaan($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }
    
    public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_penggunaan");
        $builder->orderBy("id_penggunaan", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}

    public function deleteDataPenggunaan($id_penggunaan)
    {
        // Perintah ini akan menjalankan: DELETE FROM tarif WHERE id_tarif = ...
        // Data akan hilang selamanya.
        return $this->delete($id_penggunaan);
    }
}
?>