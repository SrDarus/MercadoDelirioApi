<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    /*http://localhost/apis/MercadoDelirioApi/controller/updateCategoria.php?id=2&nombre=verduritas&descripcion=nuevaDescripcion*/
	function updateCategoria( $id, $nombre, $descripcion)
    {

        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("update categoria 
                set Nombre= ?,
                 Descripcion= ? where idCategoria = ? ");
            $stm->execute(array($nombre, $descripcion, $id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            if($r){
                return $r;

            }else{ return $r; }

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    include "../entregarResponse.php";

    if(!empty($_GET['id']) &&
        !empty($_GET['nombre']) &&
        !empty($_GET['descripcion'])){

        $_GET['id'];
    	$_GET['nombre']; 
        $_GET['descripcion'];

	    $response = updateCategoria($_GET['id'], $_GET['nombre'], $_GET['descripcion']);
        if($response===false){
            entregarResponse(200, "Los datos ingresados no corresponden", null);
        }else{
            entregarResponse(200, 0, $response);
        }
    }else{
        entregarResponse(400, "Bad request", null);
    }

?>