<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
    <title>Test online</title>
    <meta charset="utf-8">
    <meta description="Tarea online Unidad 2 DWES, test online de conocimientos sobre PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../CSS/style-for-test.css">
</head>
<?php
require_once('connect_db.php');
session_start();
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
                        <a class="droplink" href="realizar_test.php">Realizar test</a> <!--  ir a zona de usuario -->
                        
                        <a class="droplink" href="test.html">Crear usuario</a>
                        <a class="droplink" href="test.html">Iniciar secion</a>
                        <a class="droplink" href="cerrar_sesion.php">Cerrar sesion</a>
                    </nav>
                </div>


            </div>
        </header>
        <main>
            <div class="container">
            <h1>Admin web page</h1>

<?php if (isset($_SESSION['user-name']) === false) { ?>

<p>You are not logged in. Please log in and try again.</p>

<?php } else { ?>

<?php if ($_SESSION['role'] !== 'admin') { ?>

<p>You do not have permission to access this page, please log in as an administrator.</p>

<?php } else { ?>

<!-- Your admin webpage starts here -->

<p>Welcome, <?= $_SESSION['user-name'] ?>! <a href='cerrar_sesion.php'>Log out</a>.</p>

<!-- Your admin webpage ends here -->

<?php } } ?>

               
            </div>
        </main>
        <footer class="colored">

            <p>Copyright &copy; Yulia Ogarkova, 2ºDAW IES Trassierra 2021/2022</p>
        </footer>
    </div>
    <script src="scripts/header.js"></script>
    <!--<h2>Zona de administrador</h2>
  <p>El nombre del usuario con id=1 es <?php echo($result['nombre']) ?> </p>
  <table>
      <tr>
          <th>id</th>
          <th>nombre</th><th>rol</th>
      </tr>
      <tr>
          <td><?php echo($result['id']) ?></td>
          <td><?php echo($result['nombre']) ?></td>
          <td><?php echo($result['rol']) ?></td>
      </tr>
  </table>-->

</body>

</html>