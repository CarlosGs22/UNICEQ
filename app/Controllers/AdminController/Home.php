<?php

namespace App\Controllers\AdminController;

use App\Models\Admin\Departamento_Model;
use CodeIgniter\Controller;
use App\Models\Admin\Index_Model;
use App\Models\Admin\Meta_General_Model;
use App\Models\Admin\Meta_Mensual_Model;
use App\Models\Admin\Meta_Anual_Model;
use App\Models\Admin\Lineas_Model;
use App\Models\Admin\Niveles_Model;
use App\Models\Admin\Antecedentes_Model;
use App\Models\Admin\Consecuentes_Model;
use App\Models\Admin\Usuarios_Model;
use App\Models\Admin\Sub_Menu_Model;
use App\Models\Admin\Permisos_Model;
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

  public $rutaHeader = 'Admin/Marcos/header.php';
  public $rutaModulo = 'Admin/Modulos/';
  public $rutaFooter = 'Admin/Marcos/footer.php';

  public function index()
  {
    $index_model = new Index_Model();

    $submenu_model = new Sub_Menu_Model();
    $datasubmenu['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));

    $data['listas_datos'] = $index_model->_obtenerDatosInicio();
    $data['listas_promedio'] = $index_model->_obtenerPromedio();
    $data['listas_conteo'] = $index_model->_obtenerConteoIndicadores();
    echo view($this->rutaHeader, $datasubmenu);
    echo view($this->rutaModulo . 'index', $data);
    echo view($this->rutaFooter);
  }

  public function indicadores()
  {

    $index_model = new Index_Model();

    $submenu_model = new Sub_Menu_Model();
    $datasubmenu['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));

    $dataIndicadores['listas_areas'] = $index_model->_obtenerAreas();
    $dataIndicadores['listas_niveles'] = $index_model->_obtenerNiveles();
    $dataIndicadores['listas_depa'] = $index_model->_obtenerDepartamentos();

    $dataIndicadores1['lista_indicadores'] = $index_model->_obtenerIndicadores($this->session->get("idusuario"));
    $dataIndicadores2['lista_indicadores_usuario'] = $index_model->_obtenerIndicadorUsuario($this->session->get("idusuario"));
    $newArray1 = array_merge_recursive($dataIndicadores1['lista_indicadores'], $dataIndicadores2['lista_indicadores_usuario']);
    $temp1 = array_unique(array_column($newArray1, 'idindicador'));
    $dataIndicadores['lista_indicadores'] = array_intersect_key($newArray1, $temp1);

    $dataIndicadores2['lista_indicadores_estra'] = $index_model->_obtenerIndicadoresEstra($this->session->get("idusuario"));
    $dataIndicadores2['lista_indicadores_estra_usu'] = $index_model->_obtenerIndicadorUsuarioEstra($this->session->get("idusuario"));
    $newArray2 = array_merge_recursive( $dataIndicadores2['lista_indicadores_estra'], $dataIndicadores2['lista_indicadores_estra_usu']);
    $temp2 = array_unique(array_column($newArray2, 'idindicador'));
    $dataIndicadores['lista_indicadores_estra'] = array_intersect_key($newArray2, $temp2);

    echo view($this->rutaHeader, $datasubmenu);
    echo view($this->rutaModulo . 'indicadores', $dataIndicadores);
    echo view($this->rutaFooter);
  }

  public function consultaIndicador()
  {
    $index_model = new Index_Model();
    $dataIndicadores = $index_model->_obtenerIndicadorConsulta($this->request->getVar("idindicador"));
    header('Content-Type: application/json');
    echo json_encode($dataIndicadores);
  }

  public function accion_indicador()
  {
    $index_model = new Index_Model();

    $id = $this->request->getVar('txtInIndicador');

    $data = [
      'codigo' =>  $this->request->getVar('txtCodigo'),
      'indicador' =>  $this->request->getVar('txtIndicador'),
      'formula' =>  $this->request->getVar('txtFormula'),
      'periodicidad' => $this->request->getVar('txtPeriodicidad'),
      'cuando' =>  $this->request->getVar('txtCuando'),
      'unidad_medida' => $this->request->getVar('txtUnidad'),
      'estado' => $this->request->getVar('txtEstado'),
      'tipo' => $this->request->getVar('txtTipo'),
      'idarea' =>  $this->request->getVar('txtArea'),
      'idniveles' => $this->request->getVar('txtNivel'),
      'iddepartamento' => $this->request->getVar('txtDepartamento'),
      'cve_usuario' => $this->session->get("idusuario")
    ];
    $resultado = null;
    $accion = null;

    if ($id) {
      $accion = $index_model->_actualizarIndicador($id, $data);
    } else {
      $accion = $index_model->_insertarIndicador($data);
    }

    if ($accion["code"] === NULL) {
      $resultado = array('0' => "Registro guardado exitosamente", '1' => "success");
    } else {
      if ($accion["code"] == "1062") {
        $resultado = array('0' => $accion, '1' => "error");
      } else if ($accion["code"] == "2300") {
        $resultado = array('0' => "Valor duplicado", '1' => "error");
      } else {
        $resultado = array('0' => "Ocurrió un error al registrar", '1' => "error");
      }
    }
    echo json_encode($resultado);
  }



  public function consultaMetaModal()
  {
    $meta_gen_model = new Meta_General_Model();
    $dataMeta = $meta_gen_model->_obtenerMetag($this->request->getVar("idMeta"), $this->request->getVar("tipo"));
    header('Content-Type: application/json');
    echo json_encode($dataMeta);
  }


  public function consultaMetas($idindicador)
  {

    $usuario_permiso = new Usuario_Permiso_Model();
    $lista_permiso_usuario = $usuario_permiso->_validarUsuarioIndicador($this->session->get("idusuario"), $idindicador);

    if ($lista_permiso_usuario != null) {
      $index_model = new Index_Model();
      $data['listas_mensual'] = $index_model->_obtenerMetaMensual($idindicador);
      $data['listas_anual'] = $index_model->_obtenerMetaAnual($idindicador);
      $data['listas_general'] = $index_model->_obtenerMetaGeneral($idindicador);
      $data['listas_mes'] = $index_model->_obtenerMes();
      $data['listas_indicador'] = $index_model->_obtenerIndicadorConsulta($idindicador);

      $data['lista_promedio'] = $index_model->_obtenerPromedio();

      $submenu_model = new Sub_Menu_Model();
      $datasubmenu['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));

      echo view($this->rutaHeader, $datasubmenu);
      echo view($this->rutaModulo . 'metas', $data);
      echo view($this->rutaFooter);
    }else {
      return redirect()->to(site_url('login'));
    }
  }


  public function accion_meta()
  {

    $resultado = null;
    $accion = null;

    $meta_general_model = new Meta_General_Model();
    $meta_mensual_model = new Meta_Mensual_Model();
    $meta_anual_model = new Meta_Anual_Model();

    $id = $this->request->getVar('txtIdmeta');
    $tipo = $this->request->getVar('txtTipo');


    $data = [
      'anio' =>  $this->request->getVar('txtAnio'),
      'planeado' =>  $this->request->getVar('txtPlaneado'),
      'alcanzado' =>  $this->request->getVar('txtAlcanzado'),
      'estado' =>  $this->request->getVar('txtEstado'),
      'id_indicador' =>  $this->request->getVar('txtIndicador')
    ];


    if ($tipo == "meta_general") {
      if ($id) {
        $accion = $meta_general_model->_actualizarMeta($id, $data);
      } else {
        $accion =  $meta_general_model->_insertarMeta($data);
      }
    } else if ($tipo == "meta_mensual") {
      $meta_mensual_model->_actEstados($this->request->getVar('txtIndicador'));
      $new = array_merge($data, array("mes" => $this->request->getVar('txtMes')));
      if ($id) {
        $accion = $meta_mensual_model->_actualizarMeta($id, $new);
      } else {
        $accion =  $meta_mensual_model->_insertarMeta($new);
      }
    } else {
      if ($id) {
        $accion = $meta_anual_model->_actualizarMeta($id, $data);
      } else {
        $accion =  $meta_anual_model->_insertarMeta($data);
      }
    }


    if ($accion["code"] === NULL && $accion) {
      $resultado = array('0' => "Registro guardado exitosamente", '1' => "success");
    } else {
      if ($accion["code"] == "1062") {
        $resultado = array('0' => "Valor duplicado", '1' => "error");
      } else if ($accion["code"] == "2300") {
        $resultado = array('0' => "Valor duplicado", '1' => "error");
      } else {
        $resultado = array('0' => "Ocurrió un error al registrar", '1' => "error");
      }
    }
    echo json_encode($resultado);
  }


  public function lineasEstrategicas()
  {

    $lineas_model = new Lineas_Model();
    $data['listas_lineas'] = $lineas_model->_obtenerLineas();


    $submenu_model = new Sub_Menu_Model();
    $datasubmenu['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));


    echo view($this->rutaHeader, $datasubmenu);
    echo view($this->rutaModulo . 'lineas', $data);
    echo view($this->rutaFooter);
  }

  public function accion_linea()
  {
    $lineas_model = new Lineas_Model();

    $id = $this->request->getVar('txtIdArea');

    $data = [
      'area' =>  $this->request->getVar('txtArea'),
      'valor' =>  $this->request->getVar('txtValor')
    ];

    $accion = null;
    if ($id) {
      $accion = $lineas_model->_actualizarLinea($id, $data);
    } else {
      $accion = $lineas_model->_insertarLinea($data);
    }

    if ($accion["code"] == '001') {
      $resultado = array('0' => "Registro guardado exitosamente", '1' => "success");
    } else if ($accion["code"] == "2300") {
      $resultado = array('0' => "Valor duplicado", '1' => "error");
    } else if ($accion["code"] == "002") {
      $resultado = array('0' => "El valor excede el limite", '1' => "error");
    } else {
      $resultado = array('0' => "Ocurrió un error al registrar", '1' => "error");
    }

    echo json_encode($resultado);
  }

  public function nivelesBsc()
  {
    $niveles_model = new Niveles_Model();
    $data['listas_niveles'] = $niveles_model->_obtenerNiveles();

    $submenu_model = new Sub_Menu_Model();
    $datasubmenu['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));

    echo view($this->rutaHeader, $datasubmenu);
    echo view($this->rutaModulo . 'niveles', $data);
    echo view($this->rutaFooter);
  }

  public function accion_nivel()
  {
    $niveles_model = new Niveles_Model();

    $id = $this->request->getVar('txtIdNivel');

    $data = [
      'niveles' =>  $this->request->getVar('txtNivel'),
      'estado' =>  $this->request->getVar('txtEstado')
    ];

    $accion = null;
    if ($id) {
      $accion = $niveles_model->_actualizarNivel($id, $data);
    } else {
      $accion = $niveles_model->_insertarNivel($data);
    }

    if ($accion["code"] === NULL && !$accion) {
      $resultado = array('0' => "Registro guardado exitosamente", '1' => "success");
    } else if ($accion["code"] == "2300") {
      $resultado = array('0' => "Valor duplicado", '1' => "error");
    } else {
      $resultado = array('0' => "Ocurrió un error al registrar", '1' => "error");
    }
    echo json_encode($resultado);
  }

  public function departamentos()
  {
    $departamento_model = new Departamento_Model();
    $data['listas_departamentos'] = $departamento_model->_obtenerDepartamentos();

    $submenu_model = new Sub_Menu_Model();
    $datasubmenu['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));

    echo view($this->rutaHeader, $datasubmenu);
    echo view($this->rutaModulo . 'departamentos', $data);
    echo view($this->rutaFooter);
  }


  public function accion_departamento()
  {
    $departamentos_model = new Departamento_Model();

    $id = $this->request->getVar('txtIdDepartamento');

    $data = [
      'departamento' =>  $this->request->getVar('txtDepartamento'),
      'estado' =>  $this->request->getVar('txtEstado')
    ];

    $accion = null;
    if ($id) {
      $accion = $departamentos_model->_actualizarDepartamento($id, $data);
    } else {
      $accion = $departamentos_model->_insertarDepartamento($data);
    }

    if ($accion["code"] === NULL && !$accion) {
      $resultado = array('0' => "Registro guardado exitosamente", '1' => "success");
    } else if ($accion["code"] == "2300") {
      $resultado = array('0' => "Valor duplicado", '1' => "error");
    } else {
      $resultado = array('0' => "Ocurrió un error al registrar", '1' => "error");
    }
    echo json_encode($resultado);
  }

  public function obtenerAnteConse()
  {
    $antecedentes = new Antecedentes_Model();
    $dataAntecedentes = $antecedentes->_obtenerAntecedentes($this->request->getVar("id"));

    $consecuentes = new Consecuentes_Model();
    $dataConsecuentes = $consecuentes->_obtenerConsecuentes($this->request->getVar("id"));

    $lista_datos = array(
      'antecedente' => $dataAntecedentes,
      'consecuente' => $dataConsecuentes
    );

    header('Content-Type: application/json');
    echo json_encode($lista_datos);
  }

  public function accion_ante_con()
  {
    $antecedente_model = new Antecedentes_Model();
    $consecuente_model = new Consecuentes_Model();
    $id = $this->request->getVar('txtId');
    $tipo = $this->request->getVar('txtTipo');

    $accion = null;
    if ($id) {
      if ($tipo == 'antecedente') {
        $accion = $antecedente_model->_eliminarAntecedente($id);
      } else if ($tipo == 'consecuente') {
        $accion = $consecuente_model->_eliminarConsecuente($id);
      } else {
        $accion = false;
      }
    }

    if ($accion["code"] === NULL && !$accion) {
      $resultado = array('0' => "Registro guardado exitosamente", '1' => "success");
    } else if ($accion["code"] == "2300") {
      $resultado = array('0' => "Valor duplicado", '1' => "error");
    } else {
      $resultado = array('0' => "Ocurrió un error al registrar", '1' => "error");
    }
    echo json_encode($resultado);
  }

  public function obtenerIndicadoresPorArea()
  {
    $index_model = new Index_Model();
    $data = $index_model->_obtenerIndicadoresPorArea($this->request->getVar("txtArea"), $this->request->getVar("txtIndicador"));
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  public function accion_ante_con_add()
  {

    $antecedente_model = new Antecedentes_Model();
    $consecuente_model = new Consecuentes_Model();
    $idprim = $this->request->getVar('idprim');
    $idsec = $this->request->getVar('idsec');
    $valor = $this->request->getVar('val');

    $accion = null;

    $data = [
      'idindiprim' => $idprim,
      'idindisec' => $idsec
    ];

    if ($idprim && $idsec && $valor) {
      if ($valor == '1') {
        $accion = $antecedente_model->_insertarAntecedente($data);
      } else {
        if ($valor == '2') {
          $accion = $consecuente_model->_insertarConsecuente($data);
        } else {
          $accion = false;
        }
      }
    } else {
      $accion = false;
    }

    if ($accion["code"] === NULL && !$accion) {
      $resultado = array('0' => "Registro guardado exitosamente", '1' => "success");
    } else if ($accion["code"] == "2300") {
      $resultado = array('0' => "Valor duplicado", '1' => "error");
    } else {
      $resultado = array('0' => "Ocurrió un error al registrar", '1' => "error");
    }
    echo json_encode($resultado);
  }

  public function usuarios()
  {
    $usuarios_model = new Usuarios_Model();
    $index_model = new Index_Model();
    $departamento_model = new Departamento_Model();

    $data['listas_departamentos'] = $departamento_model->_obtenerDepartamentos();
    $data['listas_usuarios'] = $usuarios_model->_obtenerUsuarios($this->session->get("idusuario"));
    $data['listas_areas'] = $index_model->_obtenerAreas();

    $submenu_model = new Sub_Menu_Model();
    $datasubmenu['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));

    echo view($this->rutaHeader, $datasubmenu);
    echo view($this->rutaModulo . 'usuarios', $data);
    echo view($this->rutaFooter);
  }


  public function accion_usuario()
  {
    $usuarios_model = new Usuarios_Model();

    $id = $this->request->getVar('txtId');

    $data2 = null;
    $hash = password_hash($this->request->getVar('txtContrasenia'), PASSWORD_DEFAULT);

    $data = [
      'nombre' =>  $this->request->getVar('txtNombre'),
      'apellido_paterno' => $this->request->getVar('txtApe1'),
      'apellido_materno' => $this->request->getVar('txtApe2'),
      'usuario' =>  $this->request->getVar('txtUsuario'),
      'contrasenia' => $hash,
      'estado' => $this->request->getVar('txtEstado'),
      'iddepartamento' => $this->request->getVar('txtDepartamento')
    ];

    $nombreImg = null;
    if ($img = $this->request->getFile('imgUsuario')) {
      if ($img->isValid() && !$img->hasMoved()) {
        $nombreImg = $img->getName();
        $resImg = $img->move('./public/Admin/images/imgUsuarios', $nombreImg);
        $data2 = array_merge($data, array("imagen" => $nombreImg));
      } else {
        $data2 = $data;
      }
    } else {
      $data2 = $data;
    }

    $accion = null;

    if ($id) {
      $contras = $usuarios_model->_validarContrasenia($this->request->getVar('txtUsuario'));
      if ($contras == $this->request->getVar('txtContrasenia')) {
        $data2['contrasenia'] = $contras;
      } else {
        $data2['contrasenia'] = $hash;
      }
      $accion = $usuarios_model->_actualizarUsuario($id, $data2);
    } else {
      $accion = $usuarios_model->_insertarUsuario($data2);
    }

    $resultado = array('0' => $accion, '1' => "success");

    if ($accion["code"] == '001') {
      $resultado = array('0' => "Registro guardado exitosamente", '1' => "success");
    } else if ($accion["code"] == "2300") {
      $resultado = array('0' => "Valor duplicado", '1' => "error");
    } else if ($accion["code"] == "002") {
      $resultado = array('0' => "Ocurrio un error interno", '1' => "error");
    } else {
      $resultado = array('0' => "Ocurrió un error al registrar", '1' => "error");
    }

    echo json_encode($resultado);
  }

  public function consultaUsuario()
  {
    $usuarios_model = new Usuarios_Model();
    $data = $usuarios_model->_obtenerDetalleUsuarios($this->request->getVar("idusuario"));
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  public function login()
  {
    echo view($this->rutaModulo . 'login');
  }

  public function permisos()
  {

    $usuarios_model = new Usuarios_Model();

    $data['listas_usuarios'] = $usuarios_model->_obtenerUsuarios($this->session->get("idusuario"));

    $submenu_model = new Sub_Menu_Model();
    $datasubmenu['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));


    echo view($this->rutaHeader, $datasubmenu);
    echo view($this->rutaModulo . 'permisos', $data);
    echo view($this->rutaFooter);
  }

  public function obtenerSubmenuUsuario()
  {
    $submenu_model = new Sub_Menu_Model();
    $permiso_model = new Permisos_Model();

    $data1 = $submenu_model->_obtenerMenus();
    $data2 = $permiso_model->_obtenerPermisoUsuario($this->request->getVar('txtUsuario'));

    $lista_datos = array(
      'submenu' => $data1,
      'permiso' => $data2
    );

    header('Content-Type: application/json');
    echo json_encode($lista_datos);
  }

  public function accion_permiso()
  {

    $opcion = $this->request->getVar('opcion');
    $idsubmenu = $this->request->getVar('idsubmenu');
    $idusuario = $this->request->getVar('idusuario');

    $resultado = null;


    $accion = null;
    $permiso_model = new Permisos_Model();

    $data = [
      'idsubmenu' =>  $idsubmenu,
      'idusuario' => $idusuario
    ];

    if ($opcion == "1") {
      $accion = $permiso_model->_insertarPermiso($data);
    } else if ($opcion == "2") {
      $accion = $permiso_model->_eliminarPermiso($idsubmenu, $idusuario);
    } else {
      $accion = false;
    }

    if ($accion["code"] == '001') {
      $resultado = array('0' => "Registro guardado exitosamente", '1' => "success");
    } else if ($accion["code"] == "2300" || $accion["code"] == "1062") {
      $resultado = array('0' => "Valor duplicado", '1' => "error");
    } else if ($accion["code"] == "002") {
      $resultado = array('0' => "Ocurrio un error interno", '1' => "error");
    } else {
      $resultado = array('0' => "Ocurrió un error al registrar", '1' => "error");
    }

    echo json_encode($resultado);
  }


  public function accion_login()
  {

    $session = session();

    $usuarios_model = new Usuarios_Model();
    $permiso_model = new Permisos_Model();


    $usuario = $this->request->getVar('txtUsuario');
    $contrasenia = $this->request->getVar('txtContra');

    $validar = $usuarios_model->_validarUusuario2($usuario, $contrasenia);

    if ($validar) {
      $obtener_menu = null;
      foreach ($validar as $key => $value) {
        $obtener_menu = $permiso_model->_obtenerPermisoUsuario($value->idusuario);
        break;
      }
      if ($obtener_menu) {
        $newdata = [];
        $new = array();
        $redireccionar = null;
        foreach ($obtener_menu as $key => $value) {
          $obtener_menu = $permiso_model->_obtenerPermisoUsuario($value->idusuario);
          $redireccionar = $value->url_submenu_web;

          $newdata = [
            'idusuario'  => $value->idusuario,
            'nombre'     => $value->nombre,
            'usuario' => $value->usuario,
            'imagen' => $value->imagen,
            'estado' => $value->estado
          ];

          break;
        }

        $session->set($newdata);

        return redirect()->to(base_url("admin/inicio"));
      } else {
        $_SESSION['error'] = 'No tiene permisos asignados';
        $session->markAsFlashdata('error');
        return redirect()->to(base_url("login"));
      }
    } else {
      $_SESSION['error'] = 'Credenciales inválidas';
      $session->markAsFlashdata('error');
      return redirect()->to(base_url("login"));
    }
  }

  public function salir()
  {
    $this->session->destroy();
    return redirect()->to(base_url("login"));
  }

  public function obtenerPermisosUsuarios()
  {
    $usuario_permiso = new Usuario_Permiso_Model();
    $dataUsuarioPermiso = $usuario_permiso->_obtenerIndicadorUsuario($this->request->getVar("id"));

    header('Content-Type: application/json');
    echo json_encode($dataUsuarioPermiso);
  }


  public function accion_indicador_usuario()
  {

    $opcion = $this->request->getVar('opcion');
    $idindicador = $this->request->getVar('idindicador');
    $idusuario = $this->request->getVar('idusuario');
    $opcion = $this->request->getVar('opcion');
    $resultado = null;

    if ($idindicador != null && $idusuario != null && $opcion != null) {

      $accion = null;
      $usuario_indicador = new Usuario_Permiso_Model();

      $data = [
        'idindicador' =>  $idindicador,
        'idusuario' => $idusuario
      ];

      if ($opcion == "1") {
        $accion = $usuario_indicador->_insertarUsuario_Permiso($data);
      } else if ($opcion == "2") {
        $accion = $usuario_indicador->_eliminarIndicador_Usuario($idindicador, $idusuario);
      } else if ($opcion == "3") {
        $accion = $usuario_indicador->_eliminar1TodoIndicador_Usuario($idusuario);
      } else if ($opcion == "4") {
        $accion = $usuario_indicador->_eliminar2TodoIndicador_Usuario($idusuario);
      }

      if ($accion["code"] == '001') {
        $resultado = array('0' => "Registro guardado exitosamente", '1' => "success");
      } else if ($accion["code"] == "2300" || $accion["code"] == "1062") {
        $resultado = array('0' => "Valor duplicado", '1' => "error");
      } else if ($accion["code"] == "002") {
        $resultado = array('0' => "Ocurrio un error interno", '1' => "error");
      } else {
        $resultado = array('0' => "Ocurrió un error al registraS", '1' => "error");
      }
    } else {
      $resultado = array('0' => "Ocurrió un error al registrar", '1' => "error");
    }

    echo json_encode($resultado);
  }

  public function obtenerIndicadoresPorAreaUsuPer()
  {
    $usuario_permiso = new Usuario_Permiso_Model();
    $dataUsuarioPermiso = $usuario_permiso->_obtenerIndicadoresPorAreaUsuPer($this->request->getVar("txtArea"), $this->request->getVar("txtUsuario"));

    header('Content-Type: application/json');
    echo json_encode($dataUsuarioPermiso);
  }

  public function grafica()
  {
    $index_model = new Index_Model();
    $submenu_model = new Sub_Menu_Model();

    $datasubmenu['listas_submenu'] = $submenu_model->_obtenerSubmenu_web($this->session->get("idusuario"));
    $data['listas_areas'] = $index_model->_obtenerAreas();


    if($this->request->getVar('idIndicador') != null){
      $antecedentes = new Antecedentes_Model();
      $consecuentes = new Consecuentes_Model();
      $data['listas_indicador'] = $index_model->_obtenerIndicadorConsulta($this->request->getVar('idIndicador'));
      $data["listas_indicadoresAnte"] = $antecedentes->_obtenerAnteGraficaAnte($this->request->getVar('idIndicador'));
      $data["listas_indicadoresConse"] = $consecuentes->_obtenerAnteGraficaConse($this->request->getVar('idIndicador'));
    }
    echo view($this->rutaHeader, $datasubmenu);
    echo view($this->rutaModulo . 'grafica',$data);
    echo view($this->rutaFooter);
  }

  public function obtenerIndicadoresGrafica()
  {
    $index_model = new Index_Model();
    $dataIndicadores = $index_model->_obtenerIndiArea($this->request->getVar("txtArea"));
    header('Content-Type: application/json');
    echo json_encode($dataIndicadores);
  }

  public function obtenerGrafAnteConse()
  {
    $ante = new Antecedentes_Model();
    $dataMeta = $meta_gen_model->_obtenerMetag($this->request->getVar("idMeta"), $this->request->getVar("tipo"));
    header('Content-Type: application/json');
    echo json_encode($dataMeta);
  }



}
