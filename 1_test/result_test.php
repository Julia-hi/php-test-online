<!-- recoge resultados de test realizado por usuario y guardalos en BD -->

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
require_once('connect_db.php');
$login = $_SESSION['usuario'];

//consulta para recoger los datos del usuario
$sql2 = 'SELECT * FROM usuarios WHERE login =?'; //los datos del usuario 
$sth2 = $dbh->prepare($sql2);
$sth2->execute(array($login));
$res2 = $sth2->fetch();
$id_user = $res2['id'];
$nombre = $res2['nombre'];

//consulta para recoger los datos de la tabla preguntas
$num_preg = 'SELECT * FROM preguntas';
$sth = $dbh->prepare($num_preg);
$sth->execute();
$res=$sth->fetchAll();
$num_filas = count($res); //numero total de preguntas (de filas)


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
// funcion para validación de los datos
function filter($data){
    $data = trim($data); // Elimina espacios antes y después de los datos
    $data = stripslashes($data); // Elimina backslashes \
    $data = htmlspecialchars($data); // Traduce caracteres especiales en entidades HTML
    return $data;
}

// recogida y validación de los datos
if($_SERVER["REQUEST_METHOD"] == "POST"){


//bucle para recoger resultados de cada pregunta

    for($i = 0; $i<$num_filas; $i++){
        $opcion = ($res)[$i]['opcion']; // recoge opcion de cada pregunta
        $id_preg = ($res)[$i]['id']; // recoge id de cada pregunta
         
       $dato = ($res)[$i]['id']; //recoge id de respuesta tipo radio
       // $respuestas = $_POST['key'];
             
   
     //echo ($_POST['1']);
        //consulta de tabla respuestas
       $num_resp = 'SELECT * FROM respuestas WHERE id_pregunta='.$id_preg; //numero de respuestas de una pregunta
        $sth1 = $dbh->prepare($num_resp);
        $sth1->execute();
        $res1=$sth1->fetchAll();
        $num_filas_r = count($res1); 
        //bucle para recorrer respuestas
        for($j=0;$j<$num_filas_r;$j++){
        $resp_text = ($res1)[$j]['texto_res'];
        $id_resp= ($res1)[$j]['id'];
        $resp_valor = ($res1)[$j]['valor'];
       $consulta = $_POST."['".$j."']";
        echo gettype ($consulta);
       echo (isset($consulta));
        
        /*if($_POST[$i] ==''){
            echo("no");

        }else{
            echo("si");
            
        }*/

        } //fin del bucle para recorrer respuestas

    


    
}//fin del bucle de resultados

}else{
echo("Ha producido un error.");
}

?>


            </div>
        </main>
        <footer class="colored">
            <p>Copyright &copy; Yulia Ogarkova, 2ºDAW IES Trassierra 2021/2022</p>
        </footer>
    </div>
    <script src="scripts/header.js"></script>

</body>

</html>