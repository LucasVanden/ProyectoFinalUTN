<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);



$Menu= $URL.$AsuetoMenu;
$ABMAula= $URL.$ABMAula;

$borrarDepartamento=$URL.$borrarDepartamento;
$abmDepartamento=$URL.$abmDepartamento;
$crearMateria=$URL.$crearMateria;
$BorrarMateria=$URL.$BorrarMateria;
$abmMateria=$URL.$abmMateria;
$mostrarMaterias=$URL.$mostrarMaterias;

$a=new controladorAdministrador();
$departamentos=$a->BuscarDepartamento();




if(isset($_SESSION['departamentos'])){
    $dep=$_SESSION['departamentos'];
}else{
    $dep=2;
}

if(isset($_SESSION['idDepartamentoSeleccionado'])){
    $idDepartamento=$_SESSION['idDepartamentoSeleccionado'];
}else{
    $idDepartamento=2;
}

$materias=$a->BuscarMaterias($idDepartamento);

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
        <h2>Cargar Materia</h2>
        <form action=<?php echo $crearMateria ?> method="POST">
            <div>
             
                   
                    <tr>
                        <th>Nombre Materia</th>
                        <td>
                        <input type="text" name="nombreMateria"><br>
                        </td>
                    </tr>    
                    
<tr>
<th>Departamento</th>
<select id="first-choice" name="departamentos">
<?php 
$listadepartamento = $a->BuscarDepartamento();
//'2' por la materia q sea basica
foreach ($listadepartamento as $departamento): ?> 
<option <?php if($departamento->getid_departamento() == $dep){echo("selected");}?> value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
<?php endforeach; 
?>
</select>
</tr> 
<tr>
<th>Dia de Mesa</th>
<select id="second-choice" name="diaMesa">

<option value="1">Lunes</option>   
<option value="2">Martes</option>   
<option value="3">Miercoles</option>   
<option value="4">Jueves</option>   
<option value="5">Viernes</option>   

</select>
</tr> 


              
                  </div>
                        <div>  <input type="submit" value="Cargar Materia" name="Buscar" formaction=<?php echo $crearMateria ?> /></div>
                       

                         <select id="first-choice" name="depBuscar">
<?php 
$listadepartamento = $a->BuscarDepartamento();

foreach ($listadepartamento as $departamento): ?> 
<option <?php if($departamento->getid_departamento() == $idDepartamento){echo("selected");}?> value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
<?php endforeach; 
?>
</select>
                         <div>  <input type="submit" value="Mostrar Materias" name="Buscar" formaction=<?php echo $mostrarMaterias ?> onClick="myFunction()"/></div>
                         </form>

                     


<form action=<?php echo $BorrarMateria ?> method="POST">
<div id="myDIV" >
<table>
    <?php foreach ($materias as $mat): ?>
       
        <tr>
        <td>
        <div>
        <?php   echo $mat->getnombreMateria() ?>
        <button type="submit" value=<?php echo $mat->getid_materia()?> name="BorraridMateria" formaction=<?php echo $BorrarMateria ?> 
        onclick="return confirm('Esta seguro que desea eliminar materia <?php echo $mat->getNombreMateria()?> ')">Eliminar</button>

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

<?php if(isset($_SESSION['idDepartamentoSeleccionado'])) :?>
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