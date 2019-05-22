<?php 

    header("Access-Control-Allow-Headers:*");
    header("Access-Control-Allow-Origin: *");
    //header("Content-Type: application/json");
    //header("Access-Control-Allow-Methods", "POST");
    //header("Access-Control-Allow-Methods", "GET, POST, DELETE, PUT");

    /*http://localhost/apis/MercadoDelirioApi/controller/updateCategoria.php?id=2&nombre=verduritas*/
	function updateTipoProducto( $id, $nombre)
    {

        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("update tipoproducto 
                set Nombre= ? where idTipoProducto = ? ");

            $stm->execute(array($nombre, $id));

            $count  = $stm->rowCount();

            return $count;

        }catch (Exception $e){
            die($e->getMessage());
            return $e->getMessage();
        }
    }

    include "../entregarResponse.php";

    if(!empty($_GET['id']) &&
        !empty($_GET['nombre'])){

        $_GET['id'];
    	$_GET['nombre'];

	    $response = updateTipoProducto($_GET['id'], $_GET['nombre']);
        if($response===false){
            entregarResponse(200, "Los datos ingresados no corresponden", null);
        }else{
            entregarResponse(200, 0, $response);
        }
    }else{
        entregarResponse(400, "Bad request", null);
    }

?>