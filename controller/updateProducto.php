<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    /*http://localhost:8080/apis/MercadoDelirio/controller/getCategorias.php*/
	function upadteProucto($email, $clave)
    {

        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("SELECT email, nombre, perfil FROM user WHERE email = ? and password = ? ");
            $stm->execute(array($email,$clave));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            if($r){
                return $r;

            }else{ return $r; }

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    include "../entregarResponse.php";

    if(!empty($_GET['email']) && !empty($_GET['password'])){
    	$email = $_GET['email'];
    	$password = $_GET['password'];

	    $usuario = validarUsuario($email,$password);
        if($usuario===false){
            entregarResponse(200, "Los datos ingresados no corresponden", null);
        }else{
            entregarResponse(200, "Usuario encontrado", $usuario);
        }
    }else{
        entregarResponse(400, "Bad request", null);
    }

?>