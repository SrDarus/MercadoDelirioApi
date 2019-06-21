<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    /*http://localhost/apis/MercadoDelirioApi/controller/insertProducto.php?IdTipoProducto=1&IdUnidadMedida=1&Nombre=nuevo&Precio=1000&Img=imgTeset&Estado=1*/
	function insertUser( $Nombre, $Email, $Clave, $IdPerfil)
    {

        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("insert into usuario (Nombre, Email, Clave, IdPerfil, Estado)
                                    values (?,?,?,?,?) ");
            $stm->execute(array($Nombre, $Email, $Clave, $IdPerfil,1));
            
            $count  = $stm->rowCount();

            return $count;


        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    include "../entregarResponse.php";

    if(!empty($_GET['nombre']) &&
        !empty($_GET['email']) &&
        !empty($_GET['clave']) &&
        !empty($_GET['idperfil'])
        ){

    	$_GET['nombre']; 
        $_GET['email']; 
        $_GET['clave']; 
        $_GET['idperfil']; 

	    $response = insertUser( $_GET['nombre'], $_GET['email'], $_GET['clave'], $_GET['idperfil']);
        if($response===false){
            entregarResponse(200, "Los datos ingresados no corresponden", null);
        }else{
            entregarResponse(200, "Usuario encontrado", $response);
        }
    }else{
        entregarResponse(400, "Bad request", null);
    }

?>