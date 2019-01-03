<?php
class arrCh {
	public function __construct() {
	
		
	}

	public static function upChar ($caracteres){
		 $caracteres =  ucfirst($caracteres);
		 return $caracteres;
	}

	public static function cutChar ($caracteres){
		 $caracteres= substr($caracteres, 0, -10);
		 $caracteres = $caracteres."(..)";
		 return $caracteres;
	}
}

?>