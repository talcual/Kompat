
# Kompat

Micro Route Controller in PHP.

Esta clase busca simplificar la utilizacion de un sistema de ruteo en aplicaciones sencillas
para aquellos que no les gusta utilizar frameworks o que les parece que estos tienen demasiadas 
cosas que no se utilizan todas.

actualmente puede recibir y procesar la ruta de dos formas, la primera es una forma sencilla
y la segunda es agrupanto un grupo de rutas bajo un namespace determinado, y su procesamiento 
tambien tiene dos formas de utilizar, la primera mediante callback y la segunda procesando la 
peticion en una clase que actual como controllador.

en el ejemplo se muestran las diferentes formas.


# El Siguiente es un ejemplo de como se utiliza.

~~~~
<?php

ini_set('display_errors',1);

include 'core/model.class.php';
include 'router.php';

$r = new Router();

$r->add('/articulos/?', function($id){
	echo 'articulo #'.$id;
});

$r->add('/carro/?', '@models/carros/get');


echo '<pre>';
$r->group('/api', function($rr){
	GLOBAL $r;

	$r->add('/usuario/?', function($id){
		echo $id;
	});

	$r->add('/carros', '@models/carros');

},['needToken' => true]);
echo '</pre>';
~~~~
