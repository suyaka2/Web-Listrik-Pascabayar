<?php
namespace App\Models;
use CodeIgniter\Model;
 
class M_Tarif extends Model
{
    protected $table = 'tarif';

    // WAJIB: Beri tahu CodeIgniter nama Primary Key Anda
    protected $primaryKey = 'id_tarif';

    // WAJIB: Karena ID Anda 'TRF001' (bukan angka auto-increment)
    protected $useAutoIncrement = false;
    protected $keyType = 'string';

    protected $allowedFields = ['id_tarif', 'daya', 'tarifperkwh'];
 
    public function getDataTarif($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('daya','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('daya','ASC');
            return $query = $builder->get();
        }
    }
    
    public function saveDataTarif($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateDataTarif($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }

    public function deleteDataTarif($id_tarif)
    {
        // Perintah ini akan menjalankan: DELETE FROM tarif WHERE id_tarif = ...
        // Data akan hilang selamanya.
        return $this->delete($id_tarif);
    }
    
    public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_tarif");
        $builder->orderBy("id_tarif", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}
}
?>