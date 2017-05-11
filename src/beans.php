<?php
class Object {
	public $cols;
	
	function __construct() {
	}
	
	function __set($key, $value){
		$this->cols[$key]= $value;
	}

	function __get($key){
		return $this->cols[$key];
	}
}
?>