<?php
    class Posts{
        /**
         * JACH
         * Declaracion de variables
         */
        private $db;
        private $posts;

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
            // $this->db = Connection::conexion();
            $this->db = new PDO('mysql:host=localhost;dbname=geniat_test',"root","");
            // $this->posts = array();
        }


        /**
         * JACH
         * Se declara la funcion
         * insertData
         */
        public function insertData($request){
            $title = $_POST['title'];
            $description = $_POST['description'];
            $user_id = $_POST['user_id'];

            //genera query
            $query = "INSERT INTO post (user_id, title, description, active) VALUES ('$user_id', '$title', '$description', '1')";

            //Ejecuta query
            $result = $this->db->query($query);
            
            echo "Registro insertado con exito!";

        }
        
        /**
         * JACH
         * Se declara la funcion
         * insertData
         */
        public function updateData($id,$request){
            echo "Test";
        }

        /**
         * JACH
         * recupera todos los registros
         */
        public function getAll(){

            //genera query
            $query = "SELECT p.id,p.title, p.description, 
            CONCAT(u.`first_name`,' ',u.`last_name` )AS publicado_por,
            p.created_at,
            CASE 
                WHEN u.role = 'A' THEN 'Alto' 
                WHEN u.role = 'AM' THEN 'Alto Medio' 
                WHEN u.role = 'M' THEN 'Medio' 
                WHEN u.role = 'MA' THEN 'Medio Alto' 
                WHEN u.role = 'B' THEN 'Basico' ELSE 'NA' END  'role'
            FROM post AS p
            JOIN users AS u 
            ON p.user_id = u.`id`";

            //Ejecuta query
            $result = $this->db->query($query);


            //Recorre valores
            $array = array();

            foreach ($result as $key) {
                array_push($array,array($key));
            }             

            //Muestra resultados
            echo json_encode($array);
        }

        /**
         * JACH
         * recupera un registro por criterio
         */
        public function show($criterion){
            //genera query
            $query = "SELECT p.id,p.title, p.description, 
            CONCAT(u.`first_name`,' ',u.`last_name` )AS publicado_por,
            p.created_at,
            CASE 
                WHEN u.role = 'A' THEN 'Alto' 
                WHEN u.role = 'AM' THEN 'Alto Medio' 
                WHEN u.role = 'M' THEN 'Medio' 
                WHEN u.role = 'MA' THEN 'Medio Alto' 
                WHEN u.role = 'B' THEN 'Basico' ELSE 'NA' END  'role'
            FROM post AS p
            JOIN users AS u 
            ON p.user_id = u.`id`
            WHERE p.id LIKE '%$criterion%' 
            OR p.title LIKE '%$criterion%' 
            OR p.description LIKE '%$criterion%'";

            //Ejecuta query
            $result = $this->db->query($query);


            //Recorre valores
            $array = array();

            foreach ($result as $key) {
                
                array_push($array,array($key));
            }             

            //Muestra resultados
            echo json_encode($array);
        }
        /**
         * JACH
         * elimina un registro por criterio
         */
        public function delete($criterion){
            //genera query
            $query = "DELETE FROM post WHERE id = $criterion";
            //Ejecuta query
            $result = $this->db->query($query);


            $this->getAll();
        }
    }

