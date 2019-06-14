<?php

/**
 * carros model
 */

class carros extends Model{
	
	function __construct(){
		$this->init();
	}

	public function index(){
		echo 'el index yo soyyyyy :D';
	}

	public function get($data = array()){
		print_r($this->postdata).chr(10);
		echo 'errreeeeeeeeeee';
	}

}