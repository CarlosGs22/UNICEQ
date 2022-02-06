<?php



namespace App\Models\Admin;



use CodeIgniter\Model;



class Usuarios_Model extends Model

{

  public $table = 'usuario';



  public $primaryKey = 'idusuario';



  public $allowedFields = [

    'idusuario', 'nombre','apellido_paterno','apellido_materno','imagen','usuario',

    'contrasenia','estado','iddepartamento'

  ];



  public function _obtenerUsuarios($notUsuario)
  {
    return $this->join('departamento', 'departamento.iddepartamento = usuario.iddepartamento')
    ->where("idusuario != ",$notUsuario)->findAll();
  }

  public function _insertarUsuario($data)
  {
    try {

      $this->insert($data);

      return array('code' => "001");

    } catch (\Throwable $th) {

      return $this->error();

    }

    return array('code' => "002");

  }



  public function _actualizarUsuario($id, $data)

  {

    try {

      $this->db->transBegin();

      $this->update($id, $data);



      $query = $this->query("SELECT sum(valor) as suma FROM area");

      $total=  $query->getResult();



      $res = $total[0]->suma;



      if($res > 100){

        $this->db->transRollback();

        return array('code' => "002");

      }else{

        $this->db->transCommit();

        return array('code' => "001");

      }



    } catch (\Throwable $th) {

      return $this->error();

    }

  }





  public function _obtenerDetalleUsuarios($idusuario)

  {

    $sql = "SELECT idusuario,nombre,apellido_paterno,apellido_materno,imagen,usuario,contrasenia,estado,iddepartamento FROM usuario where idusuario = ?";

    $query = $this->query($sql,$idusuario);

    return $query->getResult();

  }





  public function _validarUusuario($usuario,$contrasenia)

  {

    $sql = "SELECT idusuario,nombre,apellido_paterno,apellido_materno,imagen,usuario,estado,iddepartamento FROM usuario where usuario = ? and contrasenia = ? limit 1";

    $query = $this->query($sql,[$usuario,$contrasenia]);

    return $query->getResult();

  }





  public function _validarUusuario2($usuario,$contrasenia)

  {

    $sql = "SELECT idusuario,nombre,apellido_paterno,apellido_materno,imagen,usuario,estado,

    iddepartamento,contrasenia FROM usuario where usuario = ? and estado = 1 limit 1";

    $query = $this->query($sql,$usuario);

    $result = $query->getResult();

    $pass;



    foreach ($result as $key => $value) {

      $pass =  $value->contrasenia;

    }





    if(password_verify($contrasenia, $pass)){

      return $result;

    } else {

      return false;

    }



  }



  public function _validarContrasenia($usuario)

  {

    $sql = "SELECT contrasenia FROM usuario where usuario = ? limit 1";

    $query = $this->query($sql,$usuario);

    $result=  $query->getResult();



    return $result[0]->contrasenia;

  }

}
