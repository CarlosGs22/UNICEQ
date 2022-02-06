<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Meta_Anual_Model extends Model
{
    public $table = 'meta_anual';

    public $primaryKey = 'id';

    public $allowedFields = [
        'id', 'anio',
        'planeado', 'alcanzado', 'planeado', 'estado','id_indicador'
    ];


    public function _actualizarMeta($id, $data)
    {
        try {
            if ($this->update($id, $data)) {
                return true;
            }
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function _insertarMeta($data)
    {
        try {
            if ($this->insert($data)) {
                return true;
            }
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
