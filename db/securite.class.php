<?php
	class securite{
		
		public static function s($string){
			 
			return  htmlspecialchars($string);
			
		}
		public static function numeric($number,$val){
			if(is_numeric($number))
				return $number;
			else
				return $val;
		}
		
		public static function is_compte_active(){
			if(isset($_SESSION['etat'])){
				if($_SESSION['etat']==0){
					echo"<span style='color:red'>ERREUR: Vous devez activer votre compte !!</span>";
					exit();
				}
			}
		}
	}
?>