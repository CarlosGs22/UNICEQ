<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Niveles_Model extends Model
{
    public $table = 'niveles';

    public $primaryKey = 'idniveles';

    public $allowedFields = [
        'idniveles', 'niveles','estado'
    ];

    public function _obtenerNiveles()
    {
        return $this->findAll();
    }

    public function _insertarNivel($data)
    {
        try {
            $this->insert($data);
        } catch (\Throwable $th) {
            return false;
        }
        return false;
    }

    public function _actualizarNivel($id, $data)
    {
        try {
            $this->update($id, $data);
        } catch (\Throwable $th) {
            return $this->error();
        }
        return false;
    }
}
