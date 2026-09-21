<?php
namespace App\Models;
use CodeIgniter\Model;
 
class M_Pembayaran extends Model
{
    protected $table = 'pembayaran';
 
    // public function getDataPembayaran($where = false)
    // {
    //     if ($where === false) {
    //         $builder = $this->db->table($this->table);
    //         $builder->select('*');
    //         $builder->orderBy('bulan_bayar','ASC');
    //         return $query = $builder->get();
    //     } else {
    //         $builder = $this->db->table($this->table);
    //         $builder->select('*');
    //         $builder->where($where);
    //         $builder->orderBy('bulan_bayar','ASC');
    //         return $query = $builder->get();
    //     }
    // }

    // public function getDataPembayaranJoin($where = false)
    // {
    //     if ($where === false) {
    //         $builder = $this->db->table($this->table);
    //         $builder->select('*');
    //         $builder->join('pelanggan','pelanggan.id_pelanggan = pembayaran.id_pelanggan','LEFT');
    //         $builder->join('tagihan','tagihan.id_tagihan = pembayaran.id_tagihan','LEFT');
    //         $builder->join('user','user.id_user = pembayaran.id_user','LEFT');
            
    //         $builder->orderBy('pembayaran.bulan_bayar','ASC');
    //         return $query = $builder->get();
    //     } else {
    //         $builder = $this->db->table($this->table);
    //         $builder->select('*');
    //         $builder->where($where);
    //         $builder->join('pelanggan','pelanggan.id_pelanggan = pembayaran.id_pelanggan','LEFT');
    //         $builder->join('tagihan','tagihan.id_tagihan = pembayaran.id_tagihan','LEFT');
    //         $builder->join('user','user.id_user = pembayaran.id_user','LEFT');
            
    //         $builder->orderBy('pembayaran.bulan_bayar','ASC');
    //         return $query = $builder->get();
    //     }
    // }

    public function getDataPembayaranJoin($where = false)
{
    if ($where === false) {
        // Blok ini berjalan untuk ADMIN (mengambil semua data)
        $builder = $this->db->table('pembayaran');

        // Pilih kolom secara spesifik
        $builder->select('
            pembayaran.tanggal_pembayaran, 
            pembayaran.total_bayar,
            pelanggan.nama_pelanggan,
            tagihan.bulan as bulan_tagihan,
            tagihan.tahun as tahun_tagihan,
            tagihan.jumlah_meter
        ');
        
        $builder->join('pelanggan', 'pelanggan.id_pelanggan = pembayaran.id_pelanggan', 'left');
        $builder->join('tagihan', 'tagihan.id_tagihan = pembayaran.id_tagihan', 'left');
        
        $builder->orderBy('pembayaran.tanggal_pembayaran', 'DESC');
        return $query = $builder->get();

    } else {
        // Blok ini berjalan untuk PELANGGAN (dengan filter)
        $builder = $this->db->table('pembayaran');

        // Pilih kolom secara spesifik
        $builder->select('
            pembayaran.tanggal_pembayaran, 
            pembayaran.total_bayar,
            pelanggan.nama_pelanggan,
            tagihan.bulan as bulan_tagihan,
            tagihan.tahun as tahun_tagihan,
            tagihan.jumlah_meter
        ');

        $builder->where($where); // Terapkan filter di sini

        $builder->join('pelanggan', 'pelanggan.id_pelanggan = pembayaran.id_pelanggan', 'left');
        $builder->join('tagihan', 'tagihan.id_tagihan = pembayaran.id_tagihan', 'left');
        
        $builder->orderBy('pembayaran.tanggal_pembayaran', 'DESC');
        return $query = $builder->get();
    }
}

//     public function getDataTagihanJoin($where = false)
// {
//     if ($where === false) {
//         // Blok ini berjalan jika tidak ada filter 'where'
//         $builder = $this->db->table($this->table);

//         // Pilih kolom yang dibutuhkan + buat kolom kalkulasi
//         $builder->select('tagihan.*, pelanggan.nama_pelanggan, pelanggan.nomor_kwh, tarif.daya, tarif.tarifperkwh');
//         $builder->select('(tagihan.jumlah_meter * tarif.tarifperkwh) as total_tagihan_calculated');
        
//         // Gabungkan tabel yang diperlukan
//         $builder->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan', 'LEFT');
//         $builder->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif', 'LEFT');
        
//         $builder->orderBy('tagihan.tahun DESC, tagihan.bulan DESC');
//         return $query = $builder->get();
//     } else {
//         // Blok ini berjalan jika ADA filter 'where'
//         $builder = $this->db->table($this->table);

//         // Pilih kolom yang dibutuhkan + buat kolom kalkulasi
//         $builder->select('tagihan.*, pelanggan.nama_pelanggan, pelanggan.nomor_kwh, tarif.daya, tarif.tarifperkwh');
//         $builder->select('(tagihan.jumlah_meter * tarif.tarifperkwh) as total_tagihan_calculated');
        
//         $builder->where($where);
        
//         // Gabungkan tabel yang diperlukan
//         $builder->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan', 'LEFT');
//         $builder->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif', 'LEFT');
        
//         $builder->orderBy('tagihan.tahun DESC, tagihan.bulan DESC');
//         return $query = $builder->get();
//     }
// }

    // Di dalam file M_Pelanggan.php

    
    public function saveDataPembayaran($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateDataPembayaran($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }
    
    public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_pembayaran");
        $builder->orderBy("id_pembayaran", "DESC");
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