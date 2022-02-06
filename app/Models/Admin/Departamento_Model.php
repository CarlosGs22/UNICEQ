<?php

namespace App\Models\Admin;

use CodeIgniter\Model;


class Departamento_Model extends Model
{
    public $table = 'departamento';

    public $primaryKey = 'iddepartamento';

    public $allowedFields = [
        'iddepartamento', 'departamento', 'estado'
    ];

    public function _obtenerDepartamentos()
    {
        return $this->findAll();
    }

    public function _insertarDepartamento($data)
    {
        try {
            $this->insert($data);
        } catch (\Throwable $th) {

            return false;
        }

        return false;
    }



    public function _actualizarDepartamento($id, $data)

    {

        try {

            $this->update($id, $data);
        } catch (\Throwable $th) {

            return $this->error();
        }

        return false;
    }
}
