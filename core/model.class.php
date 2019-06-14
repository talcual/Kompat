<?php

/**
 * Model Class
 */

class Model{
		
	public $postdata = [];

	function __construct(){
		$this->init();
	}


	public function init(){
		$this->proc_post();
	}


	public function proc_post(){
		$this->postdata = $_POST;
		unset($_POST);
	}

	public function loadModel(){
		
	}

}