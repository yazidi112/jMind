<?php
require_once("cnx.class.php");

class table {

	private $table;
	private $cnx;
	private $structure;
	private $keys;
	
	public function __construct($cnx,$table){
		$this->table=$table;
		$this->cnx=$cnx;
		$cnx=cnx::getInstance();
		$this->data=$cnx->query("SELECT * FROM ".$this->table);
		$this->structure=$this->cnx->query("SHOW COLUMNS FROM ".$this->table);
		$dt=$this->cnx->query("SHOW KEYS FROM ".$this->table);
		if(isset($dt[0]['Column_name']))
			$this->keys=$dt[0]['Column_name'];
 	}
	
	public function getData(){
		
 		return $this->data;
	}
	
	public function getStructure(){
		
 		return $this->structure;
	}
	
	public function getKeys(){
		return $this->keys;
	}
	
	
	
	public function save($values){
		$str="";
		$i=0;
		foreach($values as $value){

			if($i==0)
				$str.="null";
			else
				$str.="'".addslashes($value)."'";

			if($i<count($values)-1)
				$str.=",";
			$i++;
		}
		$sql="insert into ".$this->table." values ($str)";
		//exit($sql);
		return $this->cnx->insert($sql);
	}
	
	public function update($values){
		$str="";
		$cols="";
		$i=0;
	
		foreach($values as $value){
			$str.=$this->structure[$i][0]." = '".addslashes($value)."'";
			if($i<count($values)-1)
				$str.=", ";
				$i++;
		}
	
			
	
		$sql="update ".$this->table." set {$str} where  ".$this->keys."='{$values[0]}'";
		//exit($sql);
		return $this->cnx->update($sql);
	}
	
	public function insert($sql){
		 
  		return $this->cnx->insert($sql);
	}
	
	public function delete($id){
		$sql="delete from ".$this->table." where  ".$this->keys."='{$id}'";
		return $this->cnx->delete($sql);
	}
	
	
	public function find($id){
		$sql="select * from ".$this->table." where  ".$this->keys."='{$id}'";
		$data=$this->cnx->query($sql);
		return $data;
	}
	
	
	public function findAll(){
		$sql="select * from ".$this->table." order by ".$this->keys." desc";
		$data=$this->cnx->query($sql);
		return $data;
	}
	
	public function findBy($condition,$cols){
		$where=" WHERE 1 ";
		 
		 
		foreach($condition as $key=>$value){
			$where.=" AND {$key} = '{$value}' ";
		}
		$sql="select ".$cols." from ".$this->table;
		$sql.=$where;
		$sql.=" order by ".$this->keys." desc";
		//exit($sql);
 		$data=$this->cnx->query($sql);
		return $data;
	}
	
	
	public function _function($condition,$name,$field){
		
		$where=" WHERE 1 ";
		 
		foreach($condition as $key=>$value){
			$where.=" AND {$key} = '{$value}' ";
		}
		$sql="select ".$name."(".$field.") as value from ".$this->table;
		$sql.=$where;
		$sql.=" order by ".$this->keys." desc";
		//exit($sql);
 		$data=$this->cnx->query($sql);
		return $data;
	}
	
	public function findWhere($where,$cols){
		 
		$sql="select ".$cols." from ".$this->table." ".$where;
  		$data=$this->cnx->query($sql);
  		//exit($sql);
		return $data;
	}
	
	public function quikUpdate($id,$coloun,$value){
		$where="";
 		if(is_array($id)){
			 for($i=0;$i<count($id);$i++){
			 	foreach($id[$i] as $key=>$val){
			 		$where.=" ".$key."='".$val."'";
			 	}
			 	if($i!==count($id)-1)$where.=" AND";
 			 }
			 $sql="update ".$this->table." set  {$coloun}='{$value}'  where  $where";
			  
		}else{
			$value=addslashes($value);
			$sql="update ".$this->table." set  {$coloun}='{$value}' where  ".$this->keys."='{$id}'";
		}
		
		//exit($sql);
		$data=$this->cnx->update($sql);
		return $data;
	}
	
	public function search($keyword,$cols){
		$sql="select ".$cols." from ".$this->table;
		$where=" WHERE ";
		$i=0;
		foreach($this->structure as $key=>$value){
			$where.=" {$value[0]} LIKE '%{$keyword}%' ";
			if($i!=count($this->structure )-1)
				$where.=" OR ";
				$i++;
		}
		$sql.=$where;
		//exit($sql);
		$data=$this->cnx->query($sql);
		return $data;
	}
	
	 
	
}
?>