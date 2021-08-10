<?php

namespace App\Models;
use CodeIgniter\Model;

class EmpleadosModel extends Model {
    
	protected $table = 'empleado';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['fecha_ingreso', 'nombre', 'salario'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}