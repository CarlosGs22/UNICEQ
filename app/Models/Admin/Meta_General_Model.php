<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Meta_General_Model extends Model
{
    public $table = 'meta_general';

    public $primaryKey = 'id';

    public $allowedFields = [
        'id', 'anio',
        'planeado', 'alcanzado', 'planeado', 'estado', 'id_indicador'
    ];


    public function _obtenerMetag($id, $tipo)
    {
        if ($tipo == "meta_general") {
            $sql = "SELECT * FROM  meta_general where id = ?";
        }else  if ($tipo == "meta_mensual") {
            $sql = "SELECT * FROM  meta_mensual where id = ?";
        }else{
            $sql = "SELECT * FROM  meta_anual where id = ?";
        }

        $query = $this->query($sql, $id);
        return $query->getResult();
    }


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

    public function _actualizarEstado($id, $data)
    {
        try {
            if ($this->update($id, $data)) {
                return true;
            }
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
