<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SolicitudesModel;
use App\Models\EmpleadosModel;

class Solicitudes extends BaseController
{
	
    protected $solicitudesModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->solicitudesModel = new SolicitudesModel();
	    $this->empleadosModel = new EmpleadosModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		if (is_null($this->request->getVar('codigo')) && empty($this->request->getVar('codigo')) ) {
			$solicitudes = $this->solicitudesModel->select('solicitud.id, codigo, descripcion, resumen, id_empleado, empleado.nombre as empleado')->join('empleado', 'empleado.id = solicitud.id_empleado', 'inner');
		}else{
			$solicitudes = $this->solicitudesModel->select('solicitud.id, codigo, descripcion, resumen, id_empleado, empleado.nombre as empleado')->join('empleados', 'empleados.id = solicitud.id_empleado', 'inner')->like("codigo",$this->request->getVar("codigo"));
			$q = $this->request->getVar("codigo");
		}

		$empleados = $this->empleadosModel->select('id, nombre')->findAll();

		return $this->renderView('Solicitudes/index',["solicitudes"=>$solicitudes->findAll(),"controller"=>"solicitudes","q"=>$q,"empleados"=>$empleados],"solicitudes");
			
	}

	public function getAll()
	{
 		$response = array();		
		
	    $data['data'] = array();
 
		$result = $this->solicitudesModel->select('id, codigo, descripcion, resumen, id_empleado')->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit('. $value->id .')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove('. $value->id .')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$value->id,
				$value->codigo,
				$value->descripcion,
				$value->resumen,
				$value->id_empleado,

				$ops,
			);
		} 

		return $this->response->setJSON($data);		
	}
	

	
	public function add()
	{

        $response = array();

        $fields['id'] = $this->request->getPost('id');
        $fields['codigo'] = $this->request->getPost('codigo');
        $fields['descripcion'] = $this->request->getPost('descripcion');
        $fields['resumen'] = $this->request->getPost('resumen');
        $fields['id_empleado'] = $this->request->getPost('id_empleado');


        $this->validation->setRules([
            'codigo' => ['label' => 'Codigo', 'rules' => 'required|max_length[50]'],
            'descripcion' => ['label' => 'Descripcion', 'rules' => 'required|max_length[50]'],
            'resumen' => ['label' => 'Resumen', 'rules' => 'required|max_length[50]'],
            'id_empleado' => ['label' => 'Empleado', 'rules' => 'required|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
			
        } else {

            if ($this->solicitudesModel->insert($fields)) {
												
                $response['success'] = true;
                $response['messages'] = 'La información guardó correctamente';		
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = 'Error al guardar, por favor inténtelo de nuevo!';
				
            }
        }
		
        return $this->response->setJSON($response);
	}
		
}	