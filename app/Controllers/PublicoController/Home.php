<?php

namespace App\Controllers\PublicoController;

use App\Models\Publico\Antecedentes_Model;
use App\Models\Publico\Consecuentes_Model;
use App\Models\Publico\Detalle_Consulta;
use App\Models\Publico\Index_Model;
use App\Models\Publico\Niveles_Model;
use CodeIgniter\Controller;
use App\Models\Admin\Sub_Menu_Model;
use App\Models\Admin\Usuario_Permiso_Model;

class Home extends Controller
{


  protected $helpers = [];
  protected $session;

  public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session = \Config\Services::session($config);
  }

  public $rutaHeader = 'Publico/Marcos/header.php';
  public $rutaModulo = 'Publico/Modulos/';
  public $rutaFooter = 'Publico/Marcos/footer.php';


  public function principal()
  {
    return redirect()->to(site_url('login'));
  }

  public function index()
  {
    $submenu_model = new Sub_Menu_Model();
    $dataD['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));

    $index_model = new Index_Model();
    $dataD['lista_promedio'] = $index_model->_obtenerPromedio();
    echo view($this->rutaHeader, $dataD);
    echo view($this->rutaModulo . 'index');
    echo view($this->rutaFooter);
  }

  public function consulta()
  {
    $index_model = new Index_Model();
    $dataD['lista_promedio'] = $index_model->_obtenerPromedio();

    $submenu_model = new Sub_Menu_Model();
    $dataD['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));


    //$data['listas'] = $index_model->orderBy('idarea', 'ASC')->findAll();
    $data['listas'] = $index_model->_obtenerArea();
    echo view($this->rutaHeader, $dataD);
    echo view($this->rutaModulo . 'consulta', $data);
    echo view($this->rutaFooter);
  }

  public function consultaDetalle()
  {
    $data = null;
    $detalle_consulta = new Detalle_Consulta();
    $idarea = $this->request->getVar("idarea");
    $idusuario = $this->session->get("idusuario");

    if($idarea){
      if ($this->request->getVar("nombre")) {
        $nombre = $this->request->getVar("nombre");
        $data = $detalle_consulta->_consultaDetalle($idarea, $nombre, $idusuario);
      } else {
        $data = $detalle_consulta->_consultaDetalle($idarea, "0", $idusuario);
      }
    }else{
      if ($this->request->getVar("nombre")) {
        $nombre = $this->request->getVar("nombre");
        $data = $detalle_consulta->_obtenerIndicadoresEstra($nombre);
      }else{
        $data = $detalle_consulta->_obtenerIndicadoresEstra("0");
      }
    }
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  public function detalleIndicador($id_ind)
  {
    if ($this->session->get("idusuario") != null) {
      //$usuario_permiso = new Usuario_Permiso_Model();
      //$lista_permiso_usuario = $usuario_permiso->_validarUsuarioIndicador($this->session->get("idusuario"), $id_ind);

      //($lista_permiso_usuario != null) {
        $detalle_consulta = new Detalle_Consulta();
        $niveles_model = new Niveles_Model();

        $submenu_model = new Sub_Menu_Model();
        $dataD['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));

        $index_model = new Index_Model();
        $dataD['lista_promedio'] = $index_model->_obtenerPromedio();

        $data['lista_niveles'] = $niveles_model->orderBy('idniveles', 'ASC')->findAll();
        $data['listas'] = $detalle_consulta->where('idindicador', $id_ind)->where('estado', "1")->findAll();
        $data['listas_metas'] = $detalle_consulta->_obtenerMetas($id_ind);

        echo view($this->rutaHeader, $dataD);
        echo view($this->rutaModulo . 'detalle_indicador', $data);
        echo view($this->rutaFooter);
      /*} else {
        return redirect()->to(site_url('login'));
      }*/
    } else {
      return redirect()->to(site_url('login'));
    }
  }

  public function antecedentes()
  {
    if ($this->session->get("idusuario") != null) {
      $usuario_permiso = new Usuario_Permiso_Model();
      $lista_permiso_usuario = $usuario_permiso->_validarUsuarioIndicador($this->session->get("idusuario"), $this->request->getVar("idindicador"));

      if ($lista_permiso_usuario != null) {
        $antecedentes = new Antecedentes_Model();
        $data = $antecedentes->join('indicador', 'indicador.idindicador = antecedente.idindisec')->where(
          'antecedente.idindiprim',
          $this->request->getVar("idindicador")
          )->findAll();

          header('Content-Type: application/json');
          echo json_encode($data);
        } else {
          return redirect()->to(site_url('login'));
        }
      } else {
        return redirect()->to(site_url('login'));
      }
    }

    public function consecuentes()
    {
      if ($this->session->get("idusuario") != null) {
        $usuario_permiso = new Usuario_Permiso_Model();
        $lista_permiso_usuario = $usuario_permiso->_validarUsuarioIndicador($this->session->get("idusuario"),$this->request->getVar("idindicador"));

        if ($lista_permiso_usuario != null) {
          $antecedentes = new Consecuentes_Model();
          $data = $antecedentes->join('indicador', 'indicador.idindicador = consecuente.idindisec')->where(
            'consecuente.idindiprim',
            $this->request->getVar("idindicador")
            )->findAll();

            header('Content-Type: application/json');
            echo json_encode($data);
          }else {
            return redirect()->to(site_url('login'));
          }
        } else {
          return redirect()->to(site_url('login'));
        }
      }
    }
