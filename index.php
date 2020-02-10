<?php

   require_once ("config.php");

   //carrega um usuario
   //$root = new Usuario();
   //$root->loadById(2);
    //echo $root;

   //carrega uma lista de usuarios
   //$list = Usuario::getList();
   //echo json_encode($list);

   //carrega uma lista buscando pelo login
   //$search = Usuario::search("ch");
    //echo json_encode($search);

    //Carrega um usuario ao logar
    $usuario = new Usuario();
    $usuario->login("Matias Machos","FitDanceCanBeGAY");
    echo $usuario;
   
?>