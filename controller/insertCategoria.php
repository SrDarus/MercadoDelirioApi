<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    /*http://localhost/apis/MercadoDelirioApi/controller/insertCategoria.php?nombre=nuevo&descripcion=miDescripcion&estado=1*/
	function insertCategoria( $nombre, $descripcion)
    {

        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("insert into categoria (Nombre, Descripcion, Estado)
                                    values (?,?,?) ");
            $stm->execute(array($nombre, $descripcion, 1));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            if($r){
                return $r;

            }else{ return $r; }

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    include "../entregarResponse.php";

    if(!empty($_GET['nombre']) &&
        !empty($_GET['descripcion'])){

    	$_GET['nombre']; 
        $_GET['descripcion'];

	    $response = insertCategoria( $_GET['nombre'], $_GET['descripcion']);
        if($response===false){
            entregarResponse(200, "Los datos ingresados no corresponden", null);
        }else{
            entregarResponse(200, 0, $response);
        }
    }else{
        entregarResponse(400, "Bad request", null);
    }

?>