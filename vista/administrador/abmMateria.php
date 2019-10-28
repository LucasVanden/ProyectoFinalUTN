<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if($_SESSION['rol'] != 4){
        header('location: '. $URL.$login);
    }
  }
  
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);



$Menu= $URL.$AsuetoMenu;
$ABMAula= $URL.$ABMAula;

$borrarDepartamento=$URL.$borrarDepartamento;
$abmDepartamento=$URL.$abmDepartamento;
$crearMateria=$URL.$crearMateria;
$BorrarMateria=$URL.$BorrarMateria;
$editarmesaMateria=$URL.$editarmesaMateria;
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
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
 
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
                        <input type="text" name="nombreMateria" required><br>
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
                        <div><br><input type="submit" value="Cargar Materia" name="Buscar" formaction=<?php echo $crearMateria ?> /><br><br></div>

</form>         
<form action=<?php echo $abmMateria ?> method="POST">              
                        <h2>Ver Materias</h2>
                         <select id="first-choice" name="depBuscar">
<?php 
$listadepartamento = $a->BuscarDepartamento();

foreach ($listadepartamento as $departamento): ?> 
<option <?php if($departamento->getid_departamento() == $idDepartamento){echo("selected");}?> value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
<?php endforeach; 
?>
</select>

                         <div>  <br><input type="submit" value="Mostrar Materias" name="Buscar" formaction=<?php echo $mostrarMaterias ?> onClick="myFunction()"/></div>
                       

                       </form>



<div id="myDIV" >
<table>
    <?php foreach ($materias as $mat): ?>
    <form action=<?php echo $abmMateria ?> method="POST">         
        <tr>
        <td>
        <div>
        <?php   echo $mat->getnombreMateria() ?>

        <select name="diamesa" id="iddiamesa">

        <option <?php if($mat->getdia()->getid_dia()=='1'){echo ("selected");}?> value=1>Lunes</option>
        <option <?php if($mat->getdia()->getid_dia()=='2'){echo ("selected");}?> value=2>Martes</option>
        <option <?php if($mat->getdia()->getid_dia()=='3'){echo ("selected");}?> value=3>Miercoles</option>
        <option <?php if($mat->getdia()->getid_dia()=='4'){echo ("selected");}?> value=4>Jueves</option>
        <option <?php if($mat->getdia()->getid_dia()=='5'){echo ("selected");}?> value=5>Viernes</option>
        </select>
        <button type="submit" value=<?php echo $mat->getid_materia()?> name="BorraridMateria" formaction=<?php echo $editarmesaMateria ?> 
        onclick="return confirm('Cambiar día de mesa de <?php echo $mat->getNombreMateria()?> ')">Asignar</button>
      

        <button type="submit" value=<?php echo $mat->getid_materia()?> name="BorraridMateria" formaction=<?php echo $BorrarMateria ?> 
        onclick="return confirm('Esta seguro que desea eliminar materia <?php echo $mat->getNombreMateria()?> ')">Eliminar</button>
        </form>
        </div>
        </td>
        </tr>
        <?php endforeach; ?>
        </table>
    
</div>

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