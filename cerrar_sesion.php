<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
    <title>Tarea online U2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css">
    <!--<link rel="stylesheet" href="../css/style-for-test.css">-->
</head>
<?php   
session_start();
session_destroy();
    
    
   
?>
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
                        <a class="droplink" href="realizar_test.php">Realizar test</a>
                        <a class="droplink" href="administrar.php">Zona de administrador</a>
                        <a class="droplink" href="test.html">Crear usuario</a>
                        <a class="droplink" href="test.html">Iniciar secion</a>
                        <a class="droplink" href="#">Cerrar sesion</a>
                    </nav>
                </div>


            </div>
        </header>
       
        <main>
            <div class="container">
            <h4>Has cerrado sesión.</h4>
            </div>
        </main>
        <footer class="colored">

            <p>Copyright &copy; Yulia Ogarkova, 2ºDAW IES Trassierra 2021/2022</p>
        </footer>
    </div>
    <script src="scripts/header.js"></script>

</body>

</html>