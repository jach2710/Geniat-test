<?php
    include('../main.php');
    
    class Post{ 
        /**
         * JACH
         * Se declara el constructor
         */
        public function __construct(){

        }

        /**
         * JACH
         * Save function
         */
        public function save($request){
            require_once "../../Model/PostModel.php";    
            //Llamamos la funcion insertData del UserModel
            $newRecord = new Posts();
            $newRecord->insertData($request);
        }

        /**
         * JACH
         * update funcion
         */
        public function update($request){
            require_once "../../Model/PostModel.php";    
            //Llamamos la funcion insertData del UserModel
            $newRecord = new Posts();
            $newRecord->updateData($id,$request);
        }

        /**
         * JACH
         * get all function
         */
        public function get(){
            require_once "../../Model/PostModel.php";    
            //Llamamos la funcion insertData del UserModel
            $newRecord = new Posts();
            $newRecord->getAll();
        }

        /**
         * JACH
         * show un registro
         */
        public function show($criterion){
            require_once "../../Model/PostModel.php";    
            //Llamamos la funcion insertData del UserModel
            $newRecord = new Posts();
            $newRecord->show($criterion);
        }
        /**
         * JACH
         * Elimina un registro
         */
        public function delete($criterion){
            require_once "../../Model/PostModel.php";    
            //Llamamos la funcion insertData del UserModel
            $newRecord = new Posts();
            $newRecord->delete($criterion);
        }

    }