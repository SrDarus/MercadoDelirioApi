<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    
 	/*http://localhost:8080/apis/MercadoDelirio/controller/getCategorias.php*/
    /*  conexion POO */
	function buscarCategorias()
    {

        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("SELECT idCategoria, nombre, descripcion FROM categoria");
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

	$categorias = buscarCategorias();
    if($categorias===false){
    entregarResponse(200, "Los datos ingresados no corresponden", null);
    }else{
        entregarResponse(200, "Categorias encontradas", $categorias);
    }







 ?>