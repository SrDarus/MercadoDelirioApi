<?php 

	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    
    /*http://localhost:8080/apis/MercadoDelirioApi/controller/getAllProducts.php*/

    /*  conexion POO */
	function buscarProductos()
    {
        try{

            require_once ('../connexionPoo.php');

            $pdo = new Conexion();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");   

            $stm    = $pdo->prepare("SELECT idProducto, nombre, precio, unidad, tipoUnidad, img FROM producto");
            $stm->execute();




            $r = $stm->fetchAll(PDO::FETCH_OBJ);
            if($r){
                return $r;

            }else{ return $r;}


        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    include "../entregarResponse.php";


    $productos = buscarProductos();

    if($productos===false){
    entregarResponse(200, "Los datos ingresados no corresponden", null);
    }else{
        entregarResponse(200, "Productos encontrados", $productos);
    }





 ?>