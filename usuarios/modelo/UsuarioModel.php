<?php
	
	include('DBPDO.php');
       
	
	class Usuario extends DBPDO{
		
		public $table = 'usuarios';
		
		//public $definition = array('nombre','email','password','edad');
		//$params valores que vinene de la vista 
		public function insert($params){			
			
			return parent::insert($this->validateParams($params));
			
		}
		
		private function validateParams($params){
			
			//Hacemos la validacion
			
			return $params;
			
		}
                
                public function listar()
                {
                    return parent::all();
                  
                }








                //Podemos reescribir cualquier otro metodo de la clase heredada
		
	}