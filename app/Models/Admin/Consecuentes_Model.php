<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Consecuentes_Model extends Model
{
  public $table = 'consecuente';

  public $primaryKey = 'idconsecuente';

  public $allowedFields = [
    'idconsecuente', 'idindiprim','idindisec'
  ];

  public function _obtenerConsecuentes($id)
  {

      $sql = "SELECT * FROM consecuente
      inner join indicador on indicador.idindicador = consecuente.idindisec
      inner join area on indicador.idarea = area.idarea
      WHERE consecuente.idindiprim = ?";

      $query = $this->query($sql, $id);
      return $query->getResult();
  }

    public function _insertarConsecuente($data)
    {
      try {
        $this->insert($data);
      } catch (\Throwable $th) {
        return false;
      }
      return false;
    }

    public function _eliminarConsecuente($id)
    {
      try {
        $this->where('idconsecuente', $id)->delete();
      } catch (\Throwable $th) {
        return $this->error();
      }
      return false;
    }

    public function _obtenerAnteGraficaConse($id)
    {
      $sql = "SELECT consecuente.*, indicador.*, meta_mensual.*,area.idarea as idareaIndi, area.area as areaIndi
    FROM indicador
    inner join consecuente on indicador.idindicador = consecuente.idindisec
    INNER JOIN niveles on niveles.idniveles = indicador.idniveles
    inner join area on indicador.idarea = area.idarea
    inner join meta_mensual on meta_mensual.id_indicador = consecuente.idindiprim
    left JOIN mes on mes.id = meta_mensual.mes
    WHERE consecuente.idindiprim = ? and meta_mensual.estado = 1";
      $query = $this->query($sql, $id);
      return $query->getResult();
    }
  }
