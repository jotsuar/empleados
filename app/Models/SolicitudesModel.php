<?php

namespace App\Models;
use CodeIgniter\Model;

class SolicitudesModel extends Model {
    
	protected $table = 'solicitud';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['codigo', 'descripcion', 'resumen', 'id_empleado'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}