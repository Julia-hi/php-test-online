<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
    <title>Tarea online U2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css">
    <!--<link rel="stylesheet" href="css/style-for-test.css">-->
</head>
<?php
session_start();
require_once('connect_db.php');

//comprobamos si usuario está conectado

$login = $_SESSION['usuario'];

//consulta para recoger los datos de la table preguntas
$num_preg = 'SELECT * FROM preguntas';
$sth = $dbh->prepare($num_preg);
$sth->execute();
$res=$sth->fetchAll();
$num_filas = count($res);

//consulta para recoger los datos del usuario
$sql2 = 'SELECT * FROM usuarios WHERE login =?'; //los datos del usuario 
$sth2 = $dbh->prepare($sql2);
$sth2->execute(array($login));
$res2 = $sth2->fetch();
$id_user = $res2['id'];
$nombre = $res2['nombre'];

// consulta para recoger los datos de tabla oportunidades para saber si el usuario ya ha realizado antes el test o no
$sql3 = 'SELECT * FROM user_oportunidad WHERE id_user ='.$id_user;
$sth3 = $dbh->prepare($sql3);
$sth3->execute();
$res3 = $sth3->fetchAll();
$num_filas_oport = count($res3); //numero de ententos realizados por usuario

switch($num_filas_oport){
    case 0:
        $texto="Este es tu primer intento. (tienes como maximo tres intentos)";
        $realizar_test = true;
        break;
    case 1:
        $texto="Este es tu segundo intento. (tienes como maximo tres intentos)";
        $realizar_test = true;
        break;
    case 2:
        $texto="Este es tu ultimo intento.(tienes como maximo tres intentos)";
        $realizar_test = true; 
        default:
        $texto="Ya has gastado el limite de intentos (maximo tres), no puedes hacer el test.";
        $realizar_test = false;
        break;
}

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
                    <nav>
                       
                        <a class="droplink" href="#">Crear cuenta</a>
                        <a class="droplink" href="#">Iniciar secion</a>
                        <a class="droplink" href="#">Cerrar sesion</a>
                    </nav>
                </div>


            </div>
        </header>
        <main>
            <div class="container">
            <?php if (isset($_SESSION['usuario']) === false) { ?>

<p>Fallo de conexión. Vuelva a conectarte.</p>
<a href="test.html">Iniciar sesion</a>

<?php } elseif($realizar_test === false){
echo ("No tienes intentos.");
}else { // inicio del contenido de test ?>

<!-- Your user webpage starts here -->

<p>Hola, <?php echo($nombre) ?>! </p>
<p><?php echo($texto) //imprima informacion del numero intento ?>  </p>

<!-- Your user webpage ends here -->
<form action="result_test.php" method='POST'>
<h3>Cada pregunta tiene una o más respuestas correctas.</h3>
<?php

//bucle para recorrer preguntas
for($i=0; $i<$num_filas; $i++){ 
    $id_preg= $res[$i]['id'];
    
    $opcion = ($res)[$i]['opcion']; //opcion de pregunta, una  - para formulario tipo radio, multi para formulario tipo chackbox?>
<br/>
<h4>Pregunta <?php echo($id_preg) ?>.</h4>
<p><?php echo($res[$i]['texto_p']) ?></p>

    <?php 
    $num_resp = 'SELECT * FROM respuestas WHERE id_pregunta='.$id_preg; //numero de respuestas de una pregunta
    $sth1 = $dbh->prepare($num_resp);
    $sth1->execute();
    $res1=$sth1->fetchAll();
    $num_filas_r = count($res1); ?>
        
        <?php
    //bucle para recorrer respuestas
    for($j=0;$j<$num_filas_r;$j++){
    $resp_text = ($res1)[$j]['texto_res'];
    $id_resp= ($res1)[$j]['id'];
    $resp_valor = ($res1)[$j]['valor'];
    ?>


<?php if($opcion=="una"){ $type="radio";?> 
    <br/><input type="radio" id="<?php echo($id_resp) ?>" name="a[<?php echo ($id_preg)?>]" value = "<?php echo($resp_valor) ?>"> <?php echo($resp_text) ?>
    <?php }else{ ?><br/><input type="checkbox" id="<?php echo($id_resp) ?>" name="b[<?php echo ($id_preg)?>][<?php echo($id_resp) ?>]" value = "<?php echo($resp_valor) ?>"> <?php echo($resp_text);}?>
     

<?php } //fin del bucle - respuestas ?>

<?php } //fin del bucle  preguntas ?>
<div class="form_row"><input type="reset" value="Eliminar">
<input type = "submit" name ="submit" id = "submit" value = "Enviar"></div></form>


<?php } // fin del contenido de test ?>

            </div>
        </main>
        <footer class="colored">

            <p>Copyright &copy; Yulia Ogarkova, 2ºDAW IES Trassierra 2021/2022</p>
        </footer>
    </div>
    <script src="scripts/header.js"></script>

</body>

</html>