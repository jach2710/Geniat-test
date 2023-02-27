<?php
    include('../main.php');

    require_once "../../Model/UserModel.php";    
    class Registro{ 


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
            $this->first_name = $request['first_name'];
            $this->last_name = $request['last_name'];
            $this->email = $request['email'];
            $this->user_password = $request['user_password'];
            $this->role = $request['role'];
        }


        public function save($request){
            require_once "../../Model/UserModel.php";    
            //Llamamos la funcion insertData del UserModel
            $newRecord = new Users();
            $newRecord->insertData($request);
        }


    }