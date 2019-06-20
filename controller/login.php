<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    /*http://localhost:8080/apis/MercadoDelirio/controller/getCategorias.php*/
	function validarUsuario($email, $clave)
    {

        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("SELECT IdUsuario   ,Nombre  ,Email   ,IdPerfil    ,Estado from Usuario WHERE Email = ? and Clave = ? ");
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

    if(!empty($_GET['email']) && !empty($_GET['clave'])){
    	$email = $_GET['email'];
    	$clave = $_GET['clave'];

	    $usuario = validarUsuario($email,$clave);
        if($usuario===false){

            entregarResponse(200, 1, null);
        }else{
            entregarResponse(200, 0, $usuario);
        }
    }else{
        entregarResponse(400, "Bad request", null);
    }

?>