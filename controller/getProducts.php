<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    
    /*http://localhost:8080/apis/MercadoDelirioApi/controller/getProducts.php?idTipoProducto=1*/

    /*  conexion POO */
	function buscarProductos($idTipoProducto)
    {
        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("SELECT IdProducto, IdTipoProducto, IdUnidadMedida, Nombre, Precio, Img, Estado FROM producto where idTipoProducto = ?");
            $stm->execute(array($idTipoProducto));




            $r = $stm->fetchAll(PDO::FETCH_OBJ);
            if($r){
                return $r;

            }else{ return $r;}


        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    include "../entregarResponse.php";

    if(!empty($_GET['idTipoProducto'])){

        $idTipoProducto = $_GET['idTipoProducto'];

    	$productos = buscarProductos($idTipoProducto);

        if($productos===false){
        entregarResponse(200, "Los datos ingresados no corresponden", null);
        }else{
            entregarResponse(200, "Productos encontrados", $productos);
        }
    }else{
        entregarResponse(400, "Bad request", null);
    }





 ?>