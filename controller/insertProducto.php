<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    /*http://localhost/apis/MercadoDelirioApi/controller/insertProducto.php?IdTipoProducto=1&IdUnidadMedida=1&Nombre=nuevo&Precio=1000&Img=imgTeset&Estado=1*/
	function insertProducto( $IdTipoProducto, $IdUnidadMedida, $Nombre, $Precio, $Img, $Estado)
    {

        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("insert into producto (IdTipoProducto, IdUnidadMedida, Nombre, Precio, Img, Estado)
                                    values (?,?,?,?,?,?) ");
            $stm->execute(array($IdTipoProducto, $IdUnidadMedida, $Nombre, $Precio, $Img, $Estado));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            if($r){
                return $r;

            }else{ return $r; }

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    include "../entregarResponse.php";

    if(!empty($_GET['IdTipoProducto']) &&
        !empty($_GET['IdUnidadMedida']) &&
        !empty($_GET['Nombre']) &&
        !empty($_GET['Precio']) &&
        !empty($_GET['Img']) &&
        !empty($_GET['Estado'])){

    	$_GET['IdTipoProducto']; 
        $_GET['IdUnidadMedida']; 
        $_GET['Nombre']; 
        $_GET['Precio']; 
        $_GET['Img']; 
        $_GET['Estado'];

	    $response = insertProducto( $_GET['IdTipoProducto'], $_GET['IdUnidadMedida'], $_GET['Nombre'], $_GET['Precio'], $_GET['Img'], $_GET['Estado']);
        if($response===false){
            entregarResponse(200, "Los datos ingresados no corresponden", null);
        }else{
            entregarResponse(200, "Usuario encontrado", $usuario);
        }
    }else{
        entregarResponse(400, "Bad request", null);
    }

?>