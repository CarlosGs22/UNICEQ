<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Meta_Mensual_Model extends Model
{
  public $table = 'meta_mensual';

  public $primaryKey = 'id';

  public $allowedFields = [
    'id', 'anio','mes',
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

  public function _actEstados($idindicador)
  {
    try {
      $this->set('estado', '0', false);
      $this->where('id_indicador', $idindicador);
      if ($this->update()) {
        return true;
      }else{
        return false;
      }
    } catch (\Exception $e) {
      return $this->error();
    }
  }
}
