<?php 
    session_start();

    if (isset($_SESSION['usuario'])) 
    {
        $Nick=$_SESSION['usuario'];
    }
    else 
    {
        echo("debe autentificarse primero!!");
        die();
    }

    include("../database/DB_savelinks.php");
    if (isset($_POST['btn_Guardar--Contacto'])) 
    {
        $Nombre=$_POST['Name'];
        $Telefone=$_POST['Phone'];
        $Direccion=$_POST['Direction'];

        $Catch=new Base_Datos();
        $ConsultaSQL="INSERT INTO ageda_persona(Nombre, Telefono, Direccion, Referencia) VALUES ('$Nombre','$Telefone','$Direccion','$Nick')";
        $Guardar_Contactos=$Catch->RegistrarUsuarioDB($ConsultaSQL);
    }
    $Gatched=new Base_Datos();
    $consultaBuscarDatos="SELECT * FROM ageda_persona WHERE Referencia='$Nick'";
    $Buscar_Contactos=$Gatched->BuscarDatos($consultaBuscarDatos);

    $RandomColor = array(
        "#DE5E2B","#DE412B","#DEBE2B",
        "#9DDE2B","#2BDE85","#2BDEC8",
        "#2BA5DE","#2B5FDE","#822BDE",
        "#A82BDE","#DE2BDE","#DE2BA0"
    );
    $SelectColor=rand(0,11);
?>
<!doctype html>
<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.80.0">
        <title>Agenda</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/StylePerfiless.css">
        <link rel="stylesheet" href="../css/normalize.css">
  </head>
    <body>   
        <header>
            <div class="navbar navbar-dark bg-dark shadow-sm">
                <div class="container">
                    <a href="" class="navbar-brand d-flex align-items-center" name="Btn_Destroy" method="POST">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-zip-fill" viewBox="0 0 16 16">
                            <path d="M8.5 9.438V8.5h-1v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.93-.62-.4-1.598a1 1 0 0 1-.03-.243z"/>
                            <path d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm2.5 8.5v.938l-.4 1.599a1 1 0 0 0 .416 1.074l.93.62a1 1 0 0 0 1.109 0l.93-.62a1 1 0 0 0 .415-1.074l-.4-1.599V8.5a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1zm1-5.5h-1v1h1v1h-1v1h1v1H9V6H8V5h1V4H8V3h1V2H8V1H6.5v1h1v1z"/>
                        </svg>
                        <strong>Agenda</strong>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <a href="../Routes/Destroy_Session.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="100%" fill="#fff" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                        </svg>
                    </a>
                    </button>
                </div>
            </div>
        </header>
        <main>
            <section class="py-5 text-center container">
                <div class="row py-lg-5">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h1 class="fw-light">Bienvenido <?php echo($Nick) ?> </h1>
                        <p class="lead text-muted">la forma mas facil y segura de guardar tus contactos personales o publicos,
                        el creador, Daniel Builes. se asegurara, de que no haya ninguna toma de sus contactos personales o uso indevido de estos.</p>
                        <!-- aqui -->
                        <a class="Btnn" onclick="popupToggle()" id="RecuperaDatos">añadir contacto!</a>
                        <div id="popup">
                            <div class="content">
                                <img src="../Img/phone-book.png">
                                <h2>Agregar Contacto!</h2>
                                <form method="POST">
                                    <div class="inputbox">
                                        <input type="text" placeholder="Nombre." name="Name">
                                    </div>
                                    <div class="inputbox">
                                        <input type="number" placeholder="Telefono." name="Phone">
                                    </div>
                                    <div class="inputbox">
                                        <input type="text" placeholder="Direccion." name="Direction">
                                    </div>
                                    <div class="inputbox">
                                        <input type="submit" value="Guardar!" class="Btnn" name="btn_Guardar--Contacto">
                                    </div>
                                </form>
                            </div>
                            <a href="" class="close"><img src="../Img/cancel.png"></a>
                        </div>
                        <!-- aqui! -->
                        <a class="btn btn-secondary my-2">♡!</a>
                    </div>
                </div>
            </section>
            <div class="row row-cols-1 row-cols-md-3 g-10">
                <?php foreach($Buscar_Contactos as $Contactos): ?>
                    <div class="album py-3 bg-light">
                        <div class="container">
                            <div class="col">
                                <div class="card shadow-sm">
                                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title></title><rect width="100%" height="100%" fill="<?php echo($RandomColor[$SelectColor]); ?>"/><text x="50%" y="50%" fill="#000" dy=".4em" class="txt-title_Card"><?php echo($Contactos['Nombre']) ?></text></svg>
                                    <div class="card-body">
                                        <p class="txt_Body-Card card-text">Numero: <?php echo($Contactos['Telefono']) ?></p>
                                        <p class="txt_Body-Card card-text">Direccion: <?php echo($Contactos['Direccion'])?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="../Routes/EliminarPersona.php?id=<?php echo($Contactos['ID_Usuario'])?>"  class="Btn-Eliminar btn btn-danger">Borrar!</a>
                                            </div>
                                            <small class="text-muted"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </main>
        <footer class="text-muted py-5">
        <script>
            function popupToggle()
            {
                const popup = document.getElementById('popup');
                popup.classList.toggle('active');
            }
        </script>
        </footer>
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>