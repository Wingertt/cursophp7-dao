<?php

   require_once ("config.php");

   $sql = new Sql();

   $usuarios = $sql->Select("SELECT * FROM usuarios2");

    echo json_encode($usuarios);
?>