<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\EmpleadosModel;

class Empleados extends BaseController
{
	
    protected $empleadosModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->empleadosModel = new EmpleadosModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$q = "";
		if (is_null($this->request->getVar('nombre')) && empty($this->request->getVar('nombre')) ) {
			$empleados = $this->empleadosModel->select('id, fecha_ingreso, nombre, salario');
		}else{
			$empleados = $this->empleadosModel->select('id, fecha_ingreso, nombre, salario')->like("nombre",$this->request->getVar("nombre"));
			$q = $this->request->getVar("nombre");
		}

		return $this->renderView('Empleados/index',["empleados"=>$empleados->findAll(),"controller"=>"empleados","q"=>$q],"empleados");
			
	}

	
	
	public function add()
	{

        $response = array();

        $fields['id'] = $this->request->getPost('id');
        $fields['fecha_ingreso'] = $this->request->getPost('fechaIngreso');
        $fields['nombre'] = $this->request->getPost('nombre');
        $fields['salario'] = $this->request->getPost('salario');


        $this->validation->setRules([
            'fecha_ingreso' => ['label' => 'Fecha ingreso', 'rules' => 'required|valid_date'],
            'nombre' => ['label' => 'Nombre', 'rules' => 'required|max_length[50]'],
            'salario' => ['label' => 'Salario', 'rules' => 'required|numeric|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = implode(",", $this->validation->listErrors());
			
        } else {

            if ($this->empleadosModel->insert($fields)) {
												
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