<?php
require_once("../config.php");

class cnx{

	private $_db;
    static $_instance;

    private function __construct() {
        $this->_db = new PDO('mysql:host='.HOST.';dbname='.DB, USER, PWD);
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

   //
    
    public function query($sql){
     	$stmt = $this->_db->prepare($sql);
     	//exit($sql);
		$stmt->execute();
		$rows = $stmt->fetchAll();
		return  $rows;
    }
    
	public function insert($sql){
     	$stmt = $this->_db->prepare($sql);
     	//exit($sql);
		$stmt->execute();
		return $this->_db->lastInsertId();
    }
    
	public function delete($sql){
     	$stmt = $this->_db->prepare($sql);
		$stmt->execute();
		return $stmt->rowCount();
    }
    
	public function update($sql){
	
    	$stmt = $this->_db->prepare($sql);
    	//exit($sql);
		$stmt->execute();
		return $stmt->rowCount();
    }
    
    
    public function getConnection(){
        return $this->_db;
    }
}
?>
