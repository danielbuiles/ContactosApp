<?php
session_start();

    if ($_SESSION['usuario']) 
    { 
    }
    else 
    {
        header("location:index.html");
        die();
    }
    $id = $_GET['id'];
    include('../database/DB_savelinks.php');
    $Catch = new Base_Datos();
    $ConsultaSQL="SELECT Nombre, Telefono, Direccion FROM ageda_persona WHERE ID_Usuario='$id'";
    $DatosEncontrados=$Catch->BuscarDatos($ConsultaSQL);

    if (isset($_POST['BtnCambiar'])) 
    {
        $Name=$_POST['Nombre'];
        $Numero=$_POST['Telefono'];
        $Direc=$_POST['Direccion'];

        $ConsultaSQL="UPDATE ageda_persona SET Nombre='$Name',Telefono='$Numero',Direccion='$Direc' WHERE ID_Usuario='$id'";
        $EditarData=$Catch->EditarUsuario($ConsultaSQL);

        header('Location:Perfil.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../css//normalize.css">
    <link rel="stylesheet" href="../css//StyleEdit.css">
    <title>Hola ma friend</title>

</head>
<body>
    <?php foreach($DatosEncontrados as $Datos): ?>
        <div class="Container">
            <form method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="Nombre" value="<?php echo($Datos['Nombre']) ?>" required>
                <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Numero:</label>
                <input type="number" class="form-control" name="Telefono" value="<?php echo($Datos['Telefono']) ?>" required>
                <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Direccion:</label>
                <input type="text" class="form-control" name="Direccion" value="<?php echo($Datos['Direccion']) ?>"  required>
            </div>
            <div class=" mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">Marca esta casilla cuando estes seguro</label>
            </div>
            <button type="submit" class="btnc btn btn-warning" name="BtnCambiar">Cambiar</button>
            <a href="Perfil.php" class="link"><small href>Retroceder</small></a>
            </form>
        </div>
    <?php endforeach ?>
</body>
</html>