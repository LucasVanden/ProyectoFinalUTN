<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);



$Menu= $URL.$AsuetoMenu;
$ABMAula= $URL.$ABMAula;

$borrarDepartamento=$URL.$borrarDepartamento;
$abmDepartamento=$URL.$abmDepartamento;
$crearDepartamento=$URL.$crearDepartamento;

$a=new controladorAdministrador();
$departamentos=$a->BuscarDepartamento();

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
    <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Cargar Departamento</h2>
        <form action=<?php echo $crearDepartamento ?> method="POST">
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                   
                    <tr>
                        <th>Departamento</th>
                        <td>
                        <input type="text" name="departamento"><br>
                        </td>
                    </tr>                  
                </table>
                  </div>
                        <div>  <input type="submit" value="Cargar Aula" name="Buscar" formaction=<?php echo $crearDepartamento ?> /></div>
                   
                         </form>

                            <div>  <input type="submit" value="Mostrar Departamentos" name="Buscar" formaction=<?php echo $abmDepartamento ?> onClick="myFunction()"/></div>



<form action=<?php echo $borrarDepartamento ?> method="POST">
<div id="myDIV" >
<table>
    <?php foreach ($departamentos as $dep): ?>
       
        <tr>
        <td>
        <div>
        <?php   echo $dep->getnombre() ?>
        <button type="submit" value=<?php echo $dep->getid_departamento()?> name="borrarDepartamento" formaction=<?php echo $borrarDepartamento ?> onclick="return confirm('Esta seguro que desea eliminar departamento <?php echo $dep->getnombre()?> ')">Eliminar</button>
      
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
    <?php require $DIR.$footer; ?>     
    </footer>  
</html>