<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Antecedentes_Model extends Model
{
  public $table = 'antecedente';

  public $primaryKey = 'idantecedente';

  public $allowedFields = [
    'idantecedente', 'idindiprim','idindisec'
  ];

  public function _obtenerAntecedentes($id)
  {

    $sql = "SELECT * FROM antecedente
    inner join indicador on indicador.idindicador = antecedente.idindisec
    inner join area on indicador.idarea = area.idarea
    WHERE antecedente.idindiprim = ?";

    $query = $this->query($sql, $id);
    return $query->getResult();

  }

  public function _insertarAntecedente($data)
  {
    try {
      $this->insert($data);
    } catch (\Throwable $th) {
      return false;
    }
    return false;
  }

  public function _eliminarAntecedente($id)
  {
    try {
      $this->where('idantecedente', $id)->delete();
    } catch (\Throwable $th) {
      return $this->error();
    }
    return false;
  }


  public function _obtenerAnteGraficaAnte($id)
  {
    $sql = "SELECT antecedente.*, indicador.*,area.idarea as idareaIndi, area.area as areaIndi,meta_mensual.*,mes.mes as meses, niveles.niveles
    FROM antecedente
    inner join indicador on indicador.idindicador = antecedente.idindisec
    INNER JOIN niveles on niveles.idniveles = indicador.idniveles
    inner join area on indicador.idarea = area.idarea
    left JOIN meta_mensual on indicador.idindicador = meta_mensual.id_indicador
    INNER JOIN mes on mes.id = meta_mensual.mes
    WHERE antecedente.idindiprim = ? and meta_mensual.estado = 1";
    $query = $this->query($sql, $id);
    return $query->getResult();
  }
}
