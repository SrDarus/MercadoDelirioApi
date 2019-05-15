<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    
    /*http://localhost:8080/apis/MercadoDelirioApi/controller/getProducts.php?idCategoria=1*/

    /*  conexion POO */
	function buscarProductos($idCategoria)
    {
        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("SELECT IdProducto, IdTipoProducto, IdUnidadMedida, Nombre, Precio, Img, Estado FROM producto where idCategoria = ?");
            $stm->execute(array($idCategoria));




            $r = $stm->fetchAll(PDO::FETCH_OBJ);
            if($r){
                return $r;

            }else{ return $r;}


        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    include "../entregarResponse.php";

    if(!empty($_GET['idCategoria'])){

        $idCategoria = $_GET['idCategoria'];

    	$productos = buscarProductos($idCategoria);

        if($productos===false){
        entregarResponse(200, "Los datos ingresados no corresponden", null);
        }else{
            entregarResponse(200, "Productos encontrados", $productos);
        }
    }else{
        entregarResponse(400, "Bad request", null);
    }





 ?>