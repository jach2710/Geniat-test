<?php


    class Users{
        /**
         * JACH
         * Declaracion de variables
         */
        private $db;
        private $users;

        /**
         * JACH
         * Se declara el Constructor del modelo
         */
        public function __construct(){
            /**
             * JACH
             * Se hace una instancia al archivo
             * de conexion de db
             * 
             * se declara la variable de tipo 
             * arreglo
             */
            $this->db = new PDO('mysql:host=localhost;dbname=geniat_test',"root","");
        }


        /**
         * JACH
         * Se declara la funcion
         * insertData
         */
        public function insertData($request){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $user_password = sha1($_POST['user_password']);
            $role = $_POST['role'];

            //genera query
            $query = "INSERT INTO users (first_name, last_name, email, user_password, role) VALUES ('$first_name', '$last_name', '$email', '$user_password', '$role')";

            //Ejecuta query
            $result = $this->db->query($query);
            
            echo "Registro insertado con exito!";

        }

        /**
         * JACH
         * Login
         */
        public function login($request,$jwt){
            
            $email = $request['email'];
            $user_password = sha1($request['user_password']);
            
            // genera query            
            $query = "SELECT * FROM users WHERE email = '$email' AND user_password = '$user_password'";
            //Ejecuta query
            $result = $this->db->query($query);

            //Recorre valores
            $array = array();
            $id = null;
            foreach ($result as $key) {
                $id = $key['id'];
                array_push($array,$key['id']);
                array_push($array,$key['email']);
                array_push($array,$key['first_name']);
                array_push($array,$key['last_name']);
            }
            
            //push a arreglo
            array_push($array,$jwt);             

            //Modificacion en campo token en users
            $update = "UPDATE users
                        SET user_token = '$jwt'
                        WHERE id = $id";
            // ejecuta query
            $result = $this->db->query($update);


            //Muestra resultados
            echo json_encode($array);
            
        }

       

    }

