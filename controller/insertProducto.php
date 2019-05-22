<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    /*http://localhost/apis/MercadoDelirioApi/controller/insertProducto.php?IdTipoProducto=1&IdUnidadMedida=1&Nombre=nuevo&Precio=1000&Img=imgTeset&Estado=1*/
	function insertProducto( $IdTipoProducto, $IdUnidadMedida, $Nombre, $Precio, $Img)
    {

        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("insert into producto (IdTipoProducto, IdUnidadMedida, Nombre, Precio, Img, Estado)
                                    values (?,?,?,?,?,?) ");
            $stm->execute(array($IdTipoProducto, $IdUnidadMedida, $Nombre, $Precio, $Img, 1));
            
            $count  = $stm->rowCount();

            return $count;


        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    include "../entregarResponse.php";

    if(!empty($_GET['idTipoProducto']) &&
        !empty($_GET['idUnidadMedida']) &&
        !empty($_GET['nombre']) &&
        !empty($_GET['precio']) &&
        !empty($_GET['img'])){

    	$_GET['idTipoProducto']; 
        $_GET['idUnidadMedida']; 
        $_GET['nombre']; 
        $_GET['precio']; 
        $_GET['img']; 

	    $response = insertProducto( $_GET['idTipoProducto'], $_GET['idUnidadMedida'], $_GET['nombre'], $_GET['precio'], $_GET['img']);
        if($response===false){
            entregarResponse(200, "Los datos ingresados no corresponden", null);
        }else{
            entregarResponse(200, "Usuario encontrado", $response);
        }
    }else{
        entregarResponse(400, "Bad request", null);
    }

?>