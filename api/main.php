<?php


/**
 * JACH
 * En este archivo 
 * vamos a crear nuestra
 * estructura para determinar
 * cada metodo HTTP de tal manera
 * que se validara tambien la ruta
 * para indicar a que clase haremos
 * la instancia
 */

//declaracion de content
header("Content-Type: application/json");

//obtenemos la ruta que solicitante
$route = $_SERVER['REQUEST_URI'];

//declaramos la clase a la que haremos instancia
$class = null;

//Switch para los metodos http
switch ($_SERVER['REQUEST_METHOD']) {
        //caso POST
    case 'GET':
        // Valida si tiene parametros
        if (isset($_GET['id'])) {
            $class = new Post();
            $class->show($_GET['id']);
        } else {
            $class = new Post();
            $class->get();
        }
        break;
    case 'POST':

        //validamos las rutas
        switch ($route) {
            case '/geniat-test/api/registro/':
                // recibe datos
                $_POST = json_decode(file_get_contents('php://input'), true);

                // nueva instancia a clase registro 
                $class = new Registro($_POST);

                //al ser POST llamamos la funcion save
                $class->save($_POST);

                break;
            case '/geniat-test/api/post/':

                // recibe datos
                $_POST = json_decode(file_get_contents('php://input'), true);

                // nueva instancia a clase registro 
                $class = new Post($_POST);

                //al ser POST llamamos la funcion save
                $class->save($_POST);

                break;
            case '/geniat-test/api/login/':

                // recibe datos
                $_POST = json_decode(file_get_contents('php://input'), true);

                // nueva instancia a clase registro 
                $class = new Login($_POST);

                //al ser POST llamamos la funcion save
                $class->login($_POST);

                break;
            default:
                # code...
                break;
        }

        break;
    case 'PUT':


        //validamos las rutas
        switch ($route) {
            case '/geniat-test/api/registro/':
                // To do
                break;
            case '/geniat-test/api/post/':
                // recibe datos
                $_PUT = json_decode(file_get_contents('php://input'), true);
                print_r($_PUT);
                // nueva instancia a clase registro 
                $class = new Post();
                //al ser POST llamamos la funcion save
                $class->update($_GET['id'], $_PUT);
                break;
            case '/geniat-test/api/login/':
                // TO DO
                break;
        }

        break;
    case 'DELETE':
        $class = new Post();
        $class->delete($_GET['id']);
        break;

    default:
        echo "Metodo HTTP no permitido";
        break;
}
