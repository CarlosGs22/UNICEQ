<?php

namespace App\Models\Publico;

use CodeIgniter\Model;

class Detalle_Consulta extends Model
{
  public $table = 'indicador';

  public $primaryKey = 'idindicador ';

  public function _obtenerMetas($idindicador)
  {
    $sql = "SELECT indicador.idindicador,indicador.codigo,
    meta_mensual.anio as anio_mensual,meta_mensual.planeado as planeado_mensual,meta_mensual.alcanzado as alcanzado_mensual,
    meta_anual.anio as anio_anual,meta_anual.planeado as planeado_anual,meta_anual.alcanzado as alcanzado_anual,
    meta_general.anio as anio_general,meta_general.planeado as planeado_general,meta_general.alcanzado as alcanzado_general
    FROM  indicador
    inner join meta_mensual on meta_mensual.id_indicador = indicador.idindicador
    left join meta_anual on meta_anual.id_indicador = indicador.idindicador
    left join meta_general on meta_general.id_indicador = indicador.idindicador
    where meta_mensual.estado = 1
    and indicador.idindicador = ?";
    $query = $this->query($sql, $idindicador);
    return $query->getResult();
  }

  public function _consultaDetalle($id, $nombre,$idusuario)
  {
    if ($nombre !== "0") {
      $sql = "SELECT indicador.idindicador,indicador.codigo,indicador.indicador,
      meta_mensual.planeado,meta_mensual.alcanzado as realind
      FROM usuario_indicador
      INNER JOIN indicador on indicador.idindicador = usuario_indicador.idindicador
      INNER JOIN meta_mensual on meta_mensual.id_indicador = indicador.idindicador
      WHERE meta_mensual.estado = 1 and indicador.estado = 1 and indicador.idarea =  '" . $id . "' and (indicador.indicador like  '%" . $nombre . "%' or indicador.codigo like  '%" . $nombre . "%' ) ORDER BY indicador.idindicador ASC";
      $query = $this->query($sql);
    } else {
      $sql = "SELECT indicador.idindicador,indicador.codigo,indicador.indicador,
      meta_mensual.planeado,meta_mensual.alcanzado as realind
      FROM usuario_indicador
      INNER JOIN indicador on indicador.idindicador = usuario_indicador.idindicador
      INNER JOIN meta_mensual on meta_mensual.id_indicador = indicador.idindicador
      WHERE meta_mensual.estado = 1 and  indicador.estado = 1 and indicador.idarea = ? and usuario_indicador.idusuario = ?
      ORDER BY indicador.idindicador ASC";
      $query = $this->query($sql,[$id,$idusuario]);
    }

    return $query->getResult();
  }


  public function _obtenerIndicadoresEstra($nombre)
  {
    $sql = null;
    if($nombre == "0"){
      $sql= "SELECT indicador.idindicador,indicador.codigo,indicador.indicador,indicador.formula,indicador.estado,
      area.area,
      niveles.niveles
      FROM usuario_indicador
      INNER JOIN indicador on indicador.idindicador = usuario_indicador.idindicador
      inner join  area on area.idarea = indicador.idarea
      inner join  niveles on niveles.idniveles = indicador.idniveles
      INNER JOIN meta_mensual on meta_mensual.id_indicador = indicador.idindicador
      WHERE tipo = 2 and meta_mensual.estado = 1
      ORDER BY indicador.idindicador ASC";
    }else{
      $sql = "SELECT indicador.idindicador,indicador.codigo,indicador.indicador,indicador.formula,indicador.estado,
      area.area,
      niveles.niveles
      FROM usuario_indicador
      INNER JOIN indicador on indicador.idindicador = usuario_indicador.idindicador
      inner join  area on area.idarea = indicador.idarea
      inner join  niveles on niveles.idniveles = indicador.idniveles
      INNER JOIN meta_mensual on meta_mensual.id_indicador = indicador.idindicador
      WHERE tipo = 2 and meta_mensual.estado = 1 and indicador.estado = 1 and
      (indicador.indicador like  '%" . $nombre . "%' or indicador.codigo like  '%" . $nombre . "%' ) ORDER BY indicador.idindicador ASC";
    }
    $query = $this->query($sql);
    return $query->getResult();

  }
}
