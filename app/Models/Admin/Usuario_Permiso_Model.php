<?php



namespace App\Models\Admin;



use CodeIgniter\Model;



class Usuario_Permiso_Model extends Model

{

  public $table = 'usuario_indicador';



  public $primaryKey = 'id_usuario_indicador ';



  public $allowedFields = [
    'id_usuario_indicador', 'idindicador', 'idusuario'
  ];


  public function _obtenerIndicadorUsuario($idusuario)
  {
    $sql = "SELECT usuario_indicador.*, indicador.*,area.area
      FROM `usuario_indicador`
      INNER JOIN indicador on indicador.idindicador = usuario_indicador.idindicador
      INNER JOIN area on area.idarea = indicador.idarea
      WHERE usuario_indicador.idusuario = ?";
    $query = $this->query($sql, $idusuario);
    return $query->getResult();
  }

  public function _insertarUsuario_Permiso($data)
  {
    try {
      $this->insert($data);
      return array('code' => "001");
    } catch (\Throwable $th) {
      return $this->error();
    }
    return array('code' => "002");
  }

  public function _eliminarIndicador_Usuario($idindicador, $idusuario)
  {
    try {
      $this->where('idindicador', $idindicador)->where('idusuario', $idusuario)->delete();
      return array('code' => "001");
    } catch (\Throwable $th) {
      return $this->error();
    }
    return array('code' => "002");
  }


  public function _obtenerIndicadoresPorAreaUsuPer($idarea, $idusuario)
  {
    $sql = "SELECT indicador.*,area.*
    FROM `indicador`
    INNER JOIN area on area.idarea = indicador.idarea
    WHERE indicador.idindicador not in (
    SELECT usuario_indicador.idindicador FROM usuario_indicador 
        INNER JOIN indicador on indicador.idindicador = usuario_indicador.idindicador
        WHERE usuario_indicador.idusuario = ?
    )
     and area.idarea = ?";

    $query = $this->query($sql, [$idusuario, $idarea]);
    return $query->getResult();
  }

  public function _eliminar1TodoIndicador_Usuario($idusuario)
  {
    try {

      $this->db->transBegin();
      $sql = "DELETE FROM usuario_indicador WHERE idusuario = ?";
      $query = $this->query($sql, $idusuario);
      if ($query) {
        $sql2 = "INSERT INTO usuario_indicador (idindicador,idusuario) SELECT idindicador,concat(?) FROM indicador";
        $query2 = $this->query($sql2, $idusuario);

        if ($query2) {
          $this->db->transCommit();
          return array('code' => "001");
        } else {
          $this->db->transRollback();
          return array('code' => "002");
        }
      } else {
        $this->db->transRollback();
        return array('code' => "002");
      }
    } catch (\Throwable $th) {
      $this->db->transRollback();
      return $this->error();
    }
  }

  public function _eliminar2TodoIndicador_Usuario($idusuario)
  {
    try {
      $sql = "DELETE FROM usuario_indicador WHERE idusuario = ?";
      $query = $this->query($sql, $idusuario);
      if ($query) {
        return array('code' => "001");
      }else{
        return array('code' => "002");
      }
    } catch (\Throwable $th) {
      return $this->error();
    }
  }

  public function _validarUsuarioIndicador($idusuario,$idindicador)
    {
        return $this->where("idusuario",$idusuario)->where("idindicador",$idindicador)->findAll();
    }

}
