<?php
	class DBPDO {
		
		private $host = 'localhost';		
		private $user = 'root';		
		private $pass = '';		
		private $dbname = 'dbpruebapdo';
		
		public $lastQuery = false;
		
		public $modeDEV = false;
		
		private $persistent = true;
		
		public $errors = false;
		
		public $db;
		
		public function __construct(){
			
			$this->db = $this->Connection();
			
		}
		
		
		private function Connection(){
			
			$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
			
			$options = array( PDO::ATTR_PERSISTENT 	=>  $this->persistent,
							  PDO::ATTR_ERRMODE		=>	PDO::ERRMODE_EXCEPTION);
							  
			try {
				
				return new PDO($dsn, $this->user, $this->pass, $options);
				
				
			} catch(PDOException $e){
				
				$this->errors = $e->getMessage();
				
				if($this->modeDEV == true){ print_r($this->errors); }
				
			}
			
		}
		
		public function setTransaction(){
			
			return $this->db->beginTransaction();
			
		}
		
		public function endTransaction(){
			
			return $this->db->commit();
			
		}
		
		public function cancelTransaction(){
			
			$this->db->rollBack();
			
		}
		
		public function getID($id){
			
			$prepare = $this->db->prepare("SELECT * FROM $this->table WHERE id = '$id' ");
			
			$prepare->execute();
			
			$this->setQuery($prepare);
			
			return $prepare->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function all($limit = 10){
			
			$prepare = $this->db->prepare('SELECT * FROM '.$this->table.' LIMIT '.$limit);
			
			$prepare->execute();
			
			$this->setQuery($prepare);
			
			return $prepare->fetchAll(PDO::FETCH_ASSOC);
			
		}
		
		public function insert($params){
			
			if(!empty($params)){
				
				//Extraigo las llaves del array y lo separo por comas
				$fields = implode(',', array_keys($params));
				
				$values = ':'.implode(',:', array_keys($params));
				
				$prepare = $this->db->prepare("INSERT INTO $this->table ($fields) VALUES ($values)");
				
				$prepare->execute($this->normalizePrepareArray($params));
				
				$this->setQuery($prepare);
				
				return $this->db->lastInsertId();
				
			} else {
				
				throw new Exception('Los parametros estan vacios');
				
			}
			
		}
		
		public function update($params,$where){
			
			if(!empty($params)){
								
				$fields = '';
								
				foreach($params as $key => $value){ $fields .= $key. ' = :'.$key.','; } 
				
				$fields = rtrim($fields,",");
				
				//Obtenemos la primera key
				$key = key($where);
				
				//Obtenemos el primer valor
				$value = $where[key($where)];
				
				$prepare = $this->db->prepare("UPDATE $this->table SET $fields WHERE $key = '$value'");
				
				$prepare->execute($this->normalizePrepareArray($params));
				
				$this->setQuery($prepare);
				
			} else {
				
				throw new Exception('Los parametros estan vacios');
				
			}
		}
		
		public function delete($param){
			
			if(!empty($param)){
				
				//Obtenemos la primera key
				$key = key($param);
				
				$prepare = $this->db->prepare("DELETE FROM $this->table WHERE $key = :$key");
				
				$prepare->execute($this->normalizePrepareArray($param));
				
				$this->setQuery($prepare);
				
			} else {
				
				throw new Exception('Los parametros estan vacios');
				
			}
			
		}
		
		//Normalizamos el array y le añadimos los : delante de la key ejemplo nombre -> :nombre
		private function normalizePrepareArray($params){
			
			foreach($params as $key => $value) { $params[':'.$key] = $value; unset($params[$key]); }
			
			return $params;
			
		}
		
		public function setQuery($sql){

			if($this->modeDEV == true) $sql->debugDumpParams();

		}
		
		public function lastQuery(){
			
			return $this->lastQuery;
			
		}
		
		public function getConnection(){
			
			return $this->db;
			
		}
		
		public function setDBPassword($pass){
			
			$this->pass = $pass;
			
			$this->Connection();
			
		}
		
		public function setDBHost($host){
			
			$this->host = $host;
			
			$this->Connection();
			
		}
		
		public function setDBUser($user){
			
			$this->user = $user;
			
			$this->Connection();
			
		}
		
		public function setDBName($dbname){
			
			$this->dbname = $dbname;
			
			$this->Connection();
			
		}
		
		public function setDB($data){
			
			$this->dbname = $data['dbname'];
			$this->host = $data['host'];
			$this->user = $data['user'];
			$this->pass = $data['pass'];
			
			$this->Connection();
			
		}
		
		
	}