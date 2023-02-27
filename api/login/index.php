<?php
    include('../main.php');
    
    require_once "../../Model/UserModel.php";  
    
    use Firebase\JWT\JWT;
    class Login{ 
        /**
         * JACH
         * declaraciones
         */
        private $first_name;
        private $last_name;
        private $email;
        private $user_password;
        private $role;
        
        public function __construct(
            $request
        ){
            $this->email = $request['email'];
            $this->user_password = $request['user_password'];
        }


        /**
         * JACH
         * funcion login
         */
        public function login($request){
            require_once "../../Model/UserModel.php";    
            //Llamamos la funcion insertData del UserModel
            $newRecord = new Users();

            $jwt = $this->createJWT($request['email']);

            $newRecord->login($request,$jwt);
        }

        /**
         * JACH
         * Creacion de JWT
         */
        public function createJWT($email){
            // instancia a jwt
            require_once '../../assets/php-jwt/src/JWT.php';

            // creacion de arreglo
            $time = time();
            $key = "test_key";
            $token = array(
                'iat'=>$time,
                'exp'=>$time + (60*60),
                'email'=>$email,
            );

            $jwt = JWT::encode($token,$key,'HS256');
            // $decoded = 
            
            return $jwt;
        }
    }