<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$controladorCambiarAula);


$abmcrearAula= $URL.$abmcrearAula;
$Menu= $URL.$AsuetoMenu;
$ABMAula= $URL.$ABMAula;
$borrarAula=$URL.$borrarAula;

$a=new controladorCambiarAula();
$aulas=$a->BuscarAulas();

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
        <?php require './../partials/headera.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Cargar Aula</h2>
        <form action=<?php echo $abmcrearAula ?> method="POST">
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                   
                    <tr>
                        <th>Cuerpo</th>
                        <td>
                        <input type="text" name="cuerpo"><br>
                        </td>

                    </tr>                   
                    <th>Nivel</th>
                        <td>
                        <input type="number" name="nivel" min="-2" max="10" step="1" >
                        </td>
                        <br>

                    </tr>   
                    <th>Aula</th>
                        <td>
                        <input type="text" name="Aula"><br>
                        </td>
                        <br>

                    </tr>   
                </table>
                  </div>

 
                        <div>  <input type="submit" value="Cargar Aula" name="Buscar" formaction=<?php echo $abmcrearAula ?> /></div>
                         <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $Menu ?> /></div>
                   
                         </form>

                            <div>  <input type="submit" value="Mostrar Aulas" name="Buscar" formaction=<?php echo $ABMAula ?> onClick="myFunction()"/></div>



<form action=<?php echo $borrarAula ?> method="POST">
<div id="myDIV" >
<table>
    <?php foreach ($aulas as $aula): ?>
       
        <tr>
        <td>
        <div>
        <?php   echo $aula->getcuerpoAula() ?>
        <?php   echo $aula->getnivelAula() ?>
        <?php   echo $aula->getnumeroAula() ?>
        <input type="submit" value=<?php echo $aula->getid_aula()?> name="borrarAula" formaction=<?php echo $borrarAula ?> onclick="return confirm('Esta seguro que desea eliminar aula <?php echo $fecha?> ')"> Eliminar</input>
        </div>
        </td>
        </tr>
        <?php endforeach; ?>
        </table>
    
</div>
</form>
<script>
 var x = document.getElementById("myDIV");
 x.style.display = "none";
</script>

<?php if(isset($_SESSION['mostrarAulas'])) :?>
<script>
 var x = document.getElementById("myDIV");
 x.style.display = "block";
</script>
<?php endif; ?>



<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
} 
</script>
                



</body>
    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>