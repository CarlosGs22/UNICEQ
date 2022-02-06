<?php



namespace App\Models\Admin;



use CodeIgniter\Model;



class Permisos_Model extends Model

{

  public $table = 'permiso_menu';



  public $primaryKey = 'idpermiso';



  public $allowedFields = [

    'idpermiso', 'idusuario', 'idsubmenu'

  ];



  public function _obtenerPermisoUsuario($idusuario)

  {

    $sql = "SELECT permiso_menu.*, submenu_web.*, usuario.idusuario,usuario.usuario,usuario.nombre,usuario.imagen,usuario.estado FROM `permiso_menu` 
    INNER join submenu_web on submenu_web.id_submenu_web = permiso_menu.idsubmenu 
    INNER JOIN usuario on permiso_menu.idusuario = usuario.idusuario 
    where permiso_menu.idusuario = ?";

    $query = $this->query($sql, $idusuario);

    return $query->getResult();

  }



  public function _insertarPermiso($data)

  {

    try {

      $this->insert($data);

      return array('code' => "001");

    } catch (\Throwable $th) {

      return $this->error();

    }

    return array('code' => "002");

  }



  public function _eliminarPermiso($id,$idusuario)

  {

    try {

      $this->where('idsubmenu', $id)->where('idusuario', $idusuario)->delete();

      return array('code' => "001");

    } catch (\Throwable $th) {

      return $this->error();

    }

    return array('code' => "002");

  }





}

