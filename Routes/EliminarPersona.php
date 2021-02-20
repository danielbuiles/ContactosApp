<?php 
    session_start();
    if ($_SESSION['usuario']) 
    {
        $idUser=$_GET['id'];

        include('../database/DB_savelinks.php');
        $Catch=new Base_Datos();
        $ConsultaSQL="DELETE FROM ageda_persona WHERE ID_Usuario='$idUser'";
        $yes=$Catch->EliminarDatos($ConsultaSQL);
        header("location:../Views/Perfil.php");
    }
    else {
        echo("Registrese primero ");
    }
?>