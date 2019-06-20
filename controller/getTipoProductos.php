<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    
 	/*http://localhost:8080/apis/MercadoDelirioApi/controller/gettipoProducto.php*/
    /*  conexion POO */
	function buscarTipoProductos()
    {

        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("SELECT IdTipoProducto, Nombre FROM tipoproducto where estado = 1");
            $stm->execute();
            $r = $stm->fetchAll(PDO::FETCH_OBJ);
            if($r){
                return $r;

            }else{ return $r;}


        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    include "../entregarResponse.php";

	$tipoProducto = buscarTipoProductos();
    if($tipoProducto===false){
    entregarResponse(200, "Los datos ingresados no corresponden", null);
    }else{
        entregarResponse(200, "tipoProducto encontradas", $tipoProducto);
    }







 ?>