<?php
namespace App\Models;
use CodeIgniter\Model;
 
class M_Tagihan extends Model
{
    protected $table = 'tagihan';
 
    public function getDataTagihan($where = false)
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

    // public function getDataTagihanJoin($where = false)
    // {
    //     if ($where === false) {
    //         $builder = $this->db->table($this->table);
    //         $builder->select('*');
    //         $builder->join('pelanggan','pelanggan.id_pelanggan = tagihan.id_pelanggan','LEFT');
    //         $builder->join('penggunaan','penggunaan.id_penggunaan = tagihan.id_penggunaan','LEFT');
            
    //         $builder->orderBy('tagihan.bulan','ASC');
    //         return $query = $builder->get();
    //     } else {
    //         $builder = $this->db->table($this->table);
    //         $builder->select('*');
    //         $builder->where($where);
    //         $builder->join('pelanggan','pelanggan.id_pelanggan = tagihan.id_pelanggan','LEFT');
    //         $builder->join('penggunaan','penggunaan.id_penggunaan = tagihan.id_penggunaan','LEFT');
            
    //         $builder->orderBy('tagihan.bulan','ASC');
    //         return $query = $builder->get();
    //     }
    // }

    public function getDataTagihanJoin($where = false)
{
    if ($where === false) {
        // Blok ini berjalan untuk ADMIN (mengambil semua data)
        $builder = $this->db->table('tagihan');

        $builder->select('
            tagihan.*, 
            pelanggan.nama_pelanggan, 
            penggunaan.meter_awal, 
            penggunaan.meter_akhir, 
            tarif.daya, 
            tarif.tarifperkwh
        ');
        $builder->select('(tagihan.jumlah_meter * tarif.tarifperkwh) as total_tagihan_calculated');
        
        $builder->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan', 'left');
        $builder->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan', 'left');
        $builder->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif', 'left');
        
        $builder->orderBy('tagihan.tahun DESC, tagihan.bulan DESC');
        return $query = $builder->get();

    } else {
        // Blok ini berjalan untuk PELANGGAN (dengan filter)
        $builder = $this->db->table('tagihan');

        $builder->select('
            tagihan.*, 
            pelanggan.nama_pelanggan, 
            penggunaan.meter_awal, 
            penggunaan.meter_akhir, 
            tarif.daya, 
            tarif.tarifperkwh
        ');
        $builder->select('(tagihan.jumlah_meter * tarif.tarifperkwh) as total_tagihan_calculated');
        
        $builder->where($where); // Filter diterapkan di sini
        
        $builder->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan', 'left');
        $builder->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan', 'left');
        $builder->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif', 'left');
        
        $builder->orderBy('tagihan.tahun DESC, tagihan.bulan DESC');
        return $query = $builder->get();
    }
}

    // Di dalam file M_Pelanggan.php

    
    public function saveDataTagihan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateDataTagihan($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }
    
    public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_tagihan");
        $builder->orderBy("id_tagihan", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}

    // public function deleteDataPenggunaan($id_penggunaan)
    // {
    //     // Perintah ini akan menjalankan: DELETE FROM tarif WHERE id_tarif = ...
    //     // Data akan hilang selamanya.
    //     return $this->delete($id_penggunaan);
    // }
}
?>