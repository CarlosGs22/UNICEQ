<?php

namespace App\Models\Admin;
use App\Models\Admin\Usuario_Permiso_Model;

use CodeIgniter\Model;


class Index_Model extends Model
{
  public $table = 'indicador';

  public $primaryKey = 'idindicador';

  public $allowedFields = [
    'idindicador', 'codigo',
    'indicador', 'formula', 'periodicidad', 'cuando',
    'unidad_medida', 'estado','tipo','idarea', 'idniveles', 'iddepartamento','cve_usuario'
  ];


  public function _obtenerIndiArea($idarea)
  {
    return $this->where("idarea",$idarea)->findAll();
  }


  public function _obtenerDatosInicio()
  {
    $sql = "SELECT count(idarea) as conteos
    FROM
    area

    union all

    SELECT count(idusuario)
    FROM
    usuario

    union all

    SELECT count(idniveles)
    FROM
    niveles

    union all
    SELECT count(idinforme)
    FROM
    informe ";
    $query = $this->query($sql);
    return $query->getResult();
  }


  public function _obtenerIndicadores($idusuario)
  {
    $sql = "SELECT indicador.idindicador,indicador.codigo,indicador.indicador,indicador.formula,indicador.estado,
    area.area,
    niveles.niveles
    FROM usuario_indicador
    INNER JOIN indicador on indicador.idindicador = usuario_indicador.idindicador
    inner join  area on area.idarea = indicador.idarea
    inner join  niveles on niveles.idniveles = indicador.idniveles
    WHERE tipo = 1 and usuario_indicador.idusuario = ?
    ORDER BY indicador.idindicador ASC";
    $query = $this->query($sql,$idusuario);
    return $query->getResult();
  }

  public function _obtenerIndicadoresEstra($idusuario)
  {
    $sql = "SELECT indicador.idindicador,indicador.codigo,indicador.indicador,indicador.formula,indicador.estado,
    area.area,
    niveles.niveles
    FROM usuario_indicador
    INNER JOIN indicador on indicador.idindicador = usuario_indicador.idindicador
    inner join  area on area.idarea = indicador.idarea
    inner join  niveles on niveles.idniveles = indicador.idniveles
    WHERE tipo = 2 and usuario_indicador.idusuario = ?
    ORDER BY indicador.idindicador ASC";
    $query = $this->query($sql,$idusuario);
    return $query->getResult();
  }


  public function _obtenerIndicadorConsulta($idindicador)
  {
    $sql = "SELECT indicador.*,indicador.estado as indiEstado,
    area.idarea as idareaIndi, area.area as areaIndi,
    departamento.iddepartamento,departamento.departamento,
    niveles.idniveles,niveles.niveles,
    meta_mensual.*
    FROM  indicador
    inner join area on area.idarea = indicador.idarea
    inner join niveles on niveles.idniveles = indicador.idniveles
    inner join departamento on departamento.iddepartamento = indicador.iddepartamento
    left join meta_mensual on meta_mensual.id_indicador = indicador.idindicador
    where indicador.idindicador = ?";
    $query = $this->query($sql, $idindicador);
    return $query->getResult();
  }


  public function _obtenerAreas()
  {
    $sql = "SELECT * FROM area";
    $query = $this->query($sql);
    return $query->getResult();
  }


  public function _obtenerDepartamentos()
  {
    $sql = "SELECT * FROM departamento";
    $query = $this->query($sql);
    return $query->getResult();
  }
  public function _obtenerNiveles()
  {
    $sql = "SELECT * FROM niveles where estado = 1";
    $query = $this->query($sql);
    return $query->getResult();
  }

  public function _existeValor($value, $table, $dondeValor)
  {
    //SQL for Counting rows in a query
    $sql = "SELECT ? as valor FROM ? where codigo = ?";

    //Execute the query and assign the result to the $row variable
    $result = $this->query($sql, $value, $table, $dondeValor);
    $row = $result->getRow();

    return $row->valor;
  }

  public function _actualizarIndicador($id, $data)
  {
    try {
      if ($this->update($id, $data)) {
        return true;
      } else {
        return false;
      }
    } catch (\Exception $e) {
      return $this->error();
    }
  }

  public function _insertarIndicador($data)
  {
    $idIndi = null;
    $Usuario_Permiso_Model = new Usuario_Permiso_Model();
    try {
      $this->db->transBegin();
      if ($this->insert($data)) {

        $sql = "INSERT INTO `usuario_indicador` (`id_usuario_indicador`, `idindicador`, `idusuario`) VALUES
        (NULL, (SELECT MAX(idindicador) FROM indicador), ?)";

        $dataUsuIndi = $this->query($sql, $data["cve_usuario"]);

        if($dataUsuIndi){
          $this->db->transCommit();
          return true;
        }else{
          $this->db->transRollback();
          return false;
        }
      }else{
        return false;
      }
    } catch (\Exception $e) {
      return $this->error();
    }
  }

  public function _obtenerMetaMensual($idindicador)
  {
    $sql = "SELECT meta_mensual.id,meta_mensual.anio,mes.mes,meta_mensual.planeado,meta_mensual.alcanzado,meta_mensual.estado
    FROM  meta_mensual
    inner join indicador on indicador.idindicador = meta_mensual.id_indicador
    inner join mes on mes.id = meta_mensual.mes
    where meta_mensual.id_indicador = ? ORDER BY meta_mensual.id DESC ";
    $query = $this->query($sql, $idindicador);
    return $query->getResult();
  }

  public function _obtenerMetaAnual($idindicador)
  {
    $sql = "SELECT meta_anual.id,meta_anual.anio,meta_anual.planeado,meta_anual.alcanzado,meta_anual.estado
    FROM  meta_anual
    inner join indicador on indicador.idindicador = meta_anual.id_indicador
    where meta_anual.id_indicador = ? ORDER BY meta_anual.id DESC";
    $query = $this->query($sql, $idindicador);
    return $query->getResult();
  }

  public function _obtenerMetaGeneral($idindicador)
  {
    $sql = "SELECT meta_general.id,meta_general.anio,meta_general.planeado,meta_general.alcanzado,meta_general.estado,indicador.codigo
    FROM  meta_general
    inner join indicador on indicador.idindicador = meta_general.id_indicador
    where meta_general.id_indicador = ? ORDER BY meta_general.id DESC";
    $query = $this->query($sql, $idindicador);
    return $query->getResult();
  }
  public function _obtenerMes()
  {
    $sql = "SELECT * FROM mes";
    $query = $this->query($sql);
    return $query->getResult();
  }

  public function _obtenerConteoIndicadores()
  {
    $sql = "SELECT COUNT(idindicador) as conteo FROM indicador";
    $query = $this->query($sql);
    return $query->getResult();
  }

  public function _obtenerPromedio()
  {
    $sql = "SELECT a.idarea,
    a.area,
    count(mt.id_indicador) as metas_cum,
    (
      SELECT count(ind.idindicador) as metas_por
      FROM  area ar
      inner join indicador ind on ind.idarea = ar.idarea
      where ar.idarea = a.idarea and ind.estado = 1
    ) as metas_por,
    ((count(mt.id_indicador) / (
      SELECT count(ind.idindicador) as metas_por
      FROM  area ar
      inner join indicador ind on ind.idarea = ar.idarea
      where ar.idarea = a.idarea and ind.estado = 1
    ) * 100) * a.valor)/100 as promedio,a.valor
    FROM  meta_mensual mt
    inner join  indicador i on i.idindicador = mt.id_indicador
    inner join  area a on i.idarea = a.idarea
    where mt.alcanzado > 0
    and mt.alcanzado >= mt.planeado
    and mt.estado = 1 and i.estado = 1
    group by a.idarea";
    $query = $this->query($sql);
    return $query->getResult();
  }

  public function _obtenerIndicadoresPorArea($idarea,$idindicador)
  {

    $sql = "SELECT *
    FROM indicador
    INNER JOIN area on area.idarea = indicador.idarea
    where indicador.idindicador not in(
      SELECT indicador.idindicador
      FROM consecuente INNER JOIN indicador on consecuente.idindisec = indicador.idindicador
      WHERE consecuente.idindiprim = ?) and  indicador.idindicador not in(
        SELECT indicador.idindicador
        FROM antecedente INNER JOIN indicador on antecedente.idindisec = indicador.idindicador
        WHERE antecedente.idindiprim = ?
      )
      and indicador.idarea = ?";

      $query = $this->query($sql,[$idindicador,$idindicador,$idarea]);
      return $query->getResult();

    }

    public function _obtenerIndicadorUsuario($idusuario)
    {
      $sql = "SELECT indicador.*, area.*
      FROM indicador
      inner join  area on area.idarea = indicador.idarea
      WHERE indicador.cve_usuario = ? and tipo = 1
      ORDER BY indicador.idindicador ASC";
      $query = $this->query($sql,$idusuario);
      return $query->getResult();
    }

    public function _obtenerIndicadorUsuarioEstra($idusuario)
    {
      $sql = "SELECT indicador.*, area.*
      FROM indicador
      inner join  area on area.idarea = indicador.idarea
      WHERE indicador.cve_usuario = ? and tipo = 2
      ORDER BY indicador.idindicador ASC";
      $query = $this->query($sql,$idusuario);
      return $query->getResult();
    }

  }
