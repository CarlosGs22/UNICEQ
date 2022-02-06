<?php



namespace App\Models\Admin;



use CodeIgniter\Model;



class Lineas_Model extends Model

{

  public $table = 'area';



  public $primaryKey = 'idarea';



  public $allowedFields = [

    'idarea', 'area', 'valor'

  ];



  public function _obtenerLineas()

  {

    return $this->findAll();

  }



  public function _insertarLinea($data)

  {

    try {

      $this->db->transBegin();
      $this->insert($data);

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



  public function _actualizarLinea($id, $data)

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

}

