<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
    <title>Tarea online U2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css">
    <!--<link rel="stylesheet" href="css/style-for-test.css">-->
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
                        <h3>Test online PHP</h3>
                        <h3>Alumna: Yulia Ogarkova, 2ºDAW IES Trassierra</h3>
                    </div>
                </div>

                <div class="navigation colored">
                    <nav>
                        
                        <a class="droplink" href="test.html">Inicio</a>
                        <a class="droplink" href="cerrar_sesion.php">Cerrar sesion</a>
                    </nav>
                </div>


            </div>
        </header>
       
        <main>
            <div class="container">
                <?php
                    require_once('connect_db.php');
                    // controla si hay entrada de formulario para indentificarse
                    if(isset($_POST['user-name'])){
                    $username = $_POST['user-name'];
                    $password = $_POST['pass'];

                    // comprobamos si el usuario existe en la base de datos
                    $sql = 'SELECT * FROM usuarios WHERE login=? and contrasena=?';
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array($username, $password));
                    $result = $sth->fetch();
                    
                    if (empty($result)) { 
                ?>
                    <p>Nombre o contraseña incorrectos. Vuelva a conectarse o registrate si no tienes cuenta.</p>
                    <a href="test.html">Registrate</a>
      
                <?php } else { //cuando los datos introducidos son correctos, inicia la sesion
                    session_start();
                    $_SESSION['usuario'] = $username; 
                    $_SESSION['contrasena']=$password; 
                    $nombre = $result['nombre']; //cogemos el nombre del usuario de la BD para saludarlo
                    $rol = $result['rol'];// rol del usuario
                   if($rol=="user"){ // para rol "user" disponible solo opcion para realizar test
                        $access_type = "realizar_test.php";
                        $submit_text = "Realizar test";
                        
                    }elseif($rol =="admin"){ // para administrador disponible solo opcion para administrar (consultar resultados)
                        $access_type = "administrar.php";
                        $submit_text = "Administrar";
                    }else{ // cuando rol no esta establecida, no da opciones para continuar
                        $access_type="";
                        $submit_text="No tienes acceso. Pon en contacto con la administración.";
                    } 
                ?>
            <p>Bienvenido, </p><strong class="strong"><?php echo ($nombre)?> </strong>
                <div><a href="<?php echo($access_type) ?>"><?php echo($submit_text) ?></a></div>  <!-- enlace para realizar test o administrar, dependiendo del rol de usuario -->
               <?php }}else{
                   echo ("Error de identificación del usuario.");
                   ?>
                   <div><a href="test.html">Iniciar sesion</a></div> <?php
               } ?> 
                        
           
            </div>
        </main>
        <footer class="colored">
            <p>Copyright &copy; </p>
        </footer>
    </div>
    

</body>

</html>