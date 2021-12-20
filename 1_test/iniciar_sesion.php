<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
    <title>Tarea online U2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css">
    <!--<link rel="stylesheet" href="../css/style-for-test.css">-->
</head>

<body>
    <div class="wraped_loaded">
        <header>
            <div class="container">
                <div class="header-top">
                    <div>
                        <h3>Desarrollo web en entorno servidor</h3>
                    </div>
                    <div>
                        <h3>Tarea online Unidad 2</h3>
                        <h3>Alumna: Yulia Ogarkova, 2ºDAW IES Trassierra</h3>
                    </div>
                </div>

                <div class="navigation colored">
                    <nav><a class="droplink" href="../inicio.html">inicio</a>
                        <a class="droplink" href="#">Zona de usuario</a>
                        <a class="droplink" href="administrar.php">Zona de administrador</a>
                        <a class="droplink" href="test.html">Crear usuario</a>
                        <a class="droplink" href="test.html">Iniciar secion</a>
                        <a class="droplink" href="cerrar_sesion.php">Cerrar sesion</a>
                    </nav>
                </div>


            </div>
        </header>
       
        <main>
            <div class="container">
                <?php
                    require_once('connect_db.php');
                    $username = $_POST['user-name'];
                    $password = $_POST['pass'];

                    $sql = 'SELECT * FROM usuarios WHERE login=? and contrasena=?';
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array($username, $password));
                    $result = $sth->fetch();
                    if (empty($result)) { 
                ?>
                    <p>Your username or your password is incorrect. Please try again.</p>
                    <p>Registrate si no tienes cuenta</p>
                    <a href="crear_usuario.php">Registrate</a>
      
                <?php } else {
                    session_start();
                    $_SESSION['usuario'] = $username; 
                    $_SESSION['contrasena']=$password; 
                    $nombre = $result['nombre'];}
                    $rol = $result['rol'];
                   if($rol=="user"){
                        $access_type = "realizar_test.php";
                        $submit_text = "Realizar test";
                        echo("form: ".$access_type);
                    }elseif($rol =="admin"){
                        $access_type = "administrar.php";
                        $submit_text = "Administrar";
                    }else{
                        $access_type="";
                        $submit_text="No tienes acceso";
                    }
                ?>
            <p>Bienvenido, </p><strong><?php echo ($nombre)?> </strong>
                <a href="<?php echo($access_type) ?>"><?php echo($submit_text) ?></a>        
           
            </div>
        </main>
        <footer class="colored">
            <p>Copyright &copy; Yulia Ogarkova, 2ºDAW IES Trassierra 2021/2022</p>
        </footer>
    </div>
    <script src="scripts/header.js"></script>

</body>

</html>