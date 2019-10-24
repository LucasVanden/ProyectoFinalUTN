<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);

$a=new controladorAdministrador();

$altaMateriaAProfesor= $URL.$altaMateriaProfesor;
$darbajaMateriaProfesor= $URL.$darbajaMateriaProfesor;
$buscarmateriasProfesor= $URL.$buscarmateriasProfesor;
$bajaMateriaProfesor= $URL.$bajaMateriaProfesor;
$eliminarHorariodeCursado= $URL.$eliminarHorariodeCursado;
$menuAltaProfesor= $URL.$menuAltaProfesor;

if(isset($_POST['profesor'])){
    if(isset($_POST['Materias'])){
$listaMaterias=$a->BuscarHorarioDeCursadodeProfesorMateria($_POST['profesor'],$_POST['Materias']);
// echo '<pre>'; print_r($listaMaterias); echo '</pre>';   
}
}
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
        <h2>Dar Baja Materia Profesor</h2>
        <form action=<?php echo $bajaMateriaProfesor ?> method="POST"> <!-- -->
            <div>
                <table align='center' class="table-mostrar" id="tablaBuscar" style="border-color: #FFFFFF">  
                <tr>
                <th>Profesor</th>
                            <td>
                                <select id="idprofesor"name="profesor">
                               
                                <?php 
                               $listaprofesores = $a->BuscarProfesor();
                               foreach ($listaprofesores as $profesor): ?> 
                                <option value=<?php echo "{$profesor->getid_profesor()}" ?>> <?php echo "{$profesor->getApellido()}, {$profesor->getnombre()}" ?></option>   
                                <?php endforeach; 
                               ?>

                                </select>                                
                            </td>
                            <th>Materia</th>
                            <td>                       
                                <select id="second-choice" name="Materias">
                                </select> 
                                <script>
                 $("#idprofesor").change(function() {
                 $("#second-choice").load("<?php echo $buscarmateriasProfesor.'?choice='?>"+ $("#idprofesor").val());
                }).change();</script>

                            </td>
                        </tr>    
                </table>
            </div>
            <div>
                <br>
                <!-- <input type="submit" value="Buscar" name="Buscar" disabled="disabled" />     -->
                <input id=buttonBuscar type="submit" value="Eliminar Materia de Profesor" formaction=<?php echo $darbajaMateriaProfesor?> onclick="return confirm('Esta seguro que desea eliminar')" >
                <input id=buttonBuscar type="submit" value="Ver Horario Cursado" formaction=<?php echo $bajaMateriaProfesor?> >
                <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $menuAltaProfesor ?> /></div>
            </div>
            <div>                     
        <tr>               
                    </form>
<?php
if(isset($_POST['profesor'])):?>
 <?php if(isset($_POST['Materias'])):?>
  <table align='center' class="table-mostrar">
<th>Materia</th>
<th>Profesor</th>
<th>Dia</th>
<th>Hora Desde</th>
<th>Hora Hasta</th>
   <?php  foreach ($listaMaterias as $horacursado) : ?>
  
<tr>
<td><?php echo $horacursado->getfk_materia()->getnombreMateria()?></td>
<td><?php echo $horacursado->getProfesor()->getApellido()." ".$horacursado->getProfesor()->getNombre()?></td>
<td><?php echo $horacursado->getdia()->getdia()?></td>
<td><?php echo $horacursado->gethoraDesde()?></td>
<td><?php echo $horacursado->gethoraHasta()?></td>
<td>
<button type="submit" value=<?php echo $horacursado->getid_HorarioCursado()?> name="idhoraCursado" formaction=<?php echo $eliminarHorariodeCursado ?> onclick="return confirm('Esta seguro que desea eliminar')"> Eliminar</button>
</td>
</tr>
            <?php endforeach; ?>
            </table>
            <?php  else: echo "No hay materias"; ?>
            <?php endif?>
     
      <?php   endif?>
    <footer>
        <?php require $DIR.$footer; ?>     
    </footer>  
</html>