<?php

/**
 * Router class
 */


class Router{

	private $incluidos = [];
	
	function __construct(){
		
	}

	public function add($route, $callback){

		$uri = $_SERVER['REQUEST_URI'];
		$uri_parts = explode('/', $uri);

		$rute = $route;
		$rute_parts = explode('/',$rute);


		if(is_callable($callback)){
			if(count($uri_parts) == count($rute_parts)){
			  	if($uri_parts[1] == $rute_parts[1]){
				    if($rute_parts[count($rute_parts)-1] == '?'){
						return $callback($uri_parts[count($uri_parts)-1]);
				    }
			  	}
			}
		}else{

			$call = explode('/', $callback);

			if(is_file(str_replace('@','',$call[0]).'/'.$call[1].'.model.php')) {
				
				if(!in_array($call[1], $this->incluidos)){
					include str_replace('@','',$call[0]).'/'.$call[1].'.model.php';	
					$this->incluidos[] = $call[1];					
				}

				$mm = new $call[1];

				if(isset($call[2])){
					$am = (string)$call[2];
				}

				if(count($uri_parts) == count($rute_parts)){
				  	if($uri_parts[1] == $rute_parts[1]){
					    if($rute_parts[count($rute_parts)-1] == '?'){
					    	$mm->$am($uri_parts[count($uri_parts)-1]);
					    }else{
					    	$mm->index();
					    }
				  	}
				}
			}
		}
	}


	public function group($route, $callback,$setup = []){
		

		$uri = $_SERVER['REQUEST_URI'];
		$uri_parts = explode('/', $uri);

		$rute = $route;
		$rute_parts = explode('/',$rute);

		if($uri_parts[1] == $rute_parts[1]){
			
			if($setup['needToken']){
				if($_SERVER['HTTP_X_TANUKI'] != 'ACC870122'){
					echo 'Token Incorrecto';
					return false;
				}
			}

			$_SERVER['REQUEST_URI'] = str_replace('/'.$rute_parts[1],'',$_SERVER['REQUEST_URI']);
			return $callback($uri_parts);
		}

	}

}
