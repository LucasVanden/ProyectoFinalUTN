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
$crearDepartamento=$URL.$crearDepartamento;
$editarDepartamento=$URL.$editarDepartamento;


$a=new controladorAdministrador();
$departamentos=$a->BuscarDepartamento();

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
        <h2>Cargar Departamento</h2>
        <form action=<?php echo $crearDepartamento ?> method="POST">
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                   
                    <tr>
                        <th>Departamento</th>
                        <td>
                        <input type="text" name="departamento" required><br>
                        </td>
                    </tr>   

                    
                   <td>
                            <select name="AulaAsignada"> 
                            <?php
                            $aulas=$a->BuscarAulas();
                            foreach ($aulas as $aula): ?>
                            <option value=<?php echo $aula->getid_aula()?>> 
                            <?php 
                            echo "Cuerpo: ".$aula->getcuerpoAula()." nivel: ".$aula->getnivelAula()." aula: ".$aula->getnumeroAula();
                            ?>
                            </option>
                            <?php endforeach; ?>
                            </select>
                        </td>
                                </tr>
                              

                </table>
            </div>
            <div><input type="submit" value="Cargar Departamento" name="Buscar" formaction=<?php echo $crearDepartamento ?> /></div> 
        </form>
            <div>  <input type="submit" value="Mostrar Departamentos" name="Buscar" formaction=<?php echo $abmDepartamento ?> onClick="myFunction()"/></div>


<form action=<?php echo $borrarDepartamento ?> method="POST">
<div id="myDIV" >
<table>
<th>Departamento</th>
<th>Aula de consultas</th>
    <?php foreach ($departamentos as $dep): ?>    
    <form action=<?php echo $editarDepartamento ?> method="POST">         
        <tr>
            <td>
                <div>
                    <?php   echo $dep->getnombre() ?>
                    <?php   echo $dep->getid_departamento() ?>
                   </td>
                    <td>
                            <select name="AulaAsignada"> 
                            <?php
                            $aulas=$a->BuscarAulas();
                            foreach ($aulas as $aula): ?>
                            <option  <?php if($aula->getid_aula() == $dep->getfk_aula()){echo("selected");}?> value=<?php echo $aula->getid_aula()?>> 
                            <?php 
                            echo "Cuerpo: ".$aula->getcuerpoAula()." nivel: ".$aula->getnivelAula()." aula: ".$aula->getnumeroAula();
                            ?>
                            </option>
                            <?php endforeach; ?>
                            </select>
                        </td>

                              <td>
                    <button type="submit" id="buttonAsistir" name="asignar" value=<?php echo $dep->getid_departamento()?> formaction=<?php echo $editarDepartamento?>> asignar </button>
                    </form>
                    </td> 

                        <td>
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