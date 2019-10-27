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
//antes de romper
$a=new controladorAdministrador();

$altaMateriaAProfesor= $URL.$altaMateriaProfesor;
$departamentoMaterias= $URL.$departamentoMaterias;
$menuAltaProfesor= $URL.$menuAltaProfesor;

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
        <h2>Asignar Materia a Profesor</h2>
        <form action=<?php echo $altaMateriaAProfesor ?> method="POST"> <!-- -->
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                <tr>
                <th>Profesor</th>
                            <td>
                                <select name="profesor">
                               
                                <?php 
                               $listaprofesores = $a->BuscarProfesor();
                               foreach ($listaprofesores as $profesor): ?> 
                                <option value=<?php echo "{$profesor->getid_profesor()}" ?>> <?php echo "{$profesor->getApellido()}, {$profesor->getnombre()}" ?></option>   
                                <?php endforeach; 
                               ?>

                                </select>                                
                            </td>
                            <th>Departamento</th>
                            <td>                                
                                <select id="first-choice" name="departamentos">

                                       <?php 
                               $listadepartamento = $a->BuscarDepartamento();
                               foreach ($listadepartamento as $departamento): ?> 
                                <option value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
                                <?php endforeach; 
                               ?>
                                </select>
                            </td>
                            <th>Materia</th>
                            <td>                       
                                <select id="second-choice" name="Materias">
                                </select> 
                                <script>
                 $("#first-choice").change(function() {
                 $("#second-choice").load("<?php echo $departamentoMaterias.'?choice='?>"+ $("#first-choice").val());
                }).change();</script>


                            </td>
                            
                            <th>Semestral Anual</th>
                            <td>
                            <select id="second-choice" name="semestreAnual">

<option value="1">1 semestre</option>   
<option value="2">2 semestre</option>   
<option value="anual">Anual</option>   

</td>
</tr>
</select>

                            <th>Dedicacion</th>
                            <td>

                            <select name="dedicacion">
                               
                               <?php 
                              $listadedicacion = $a->BuscarDedicacion();
                              foreach ($listadedicacion as $ded): ?> 
                               <option value=<?php echo $ded->getid_dedicacion() ?>> <?php echo $ded->gettipo() ?></option>   
                               <?php endforeach; 
                              ?>

                               </select>   
                        </td>
                        </tr>   
                        
<tr>
<th>Dia de cursado</th>
<td>
<select id="second-choice" name="dia">

<option value="1">Lunes</option>   
<option value="2">Martes</option>   
<option value="3">Miercoles</option>   
<option value="4">Jueves</option>   
<option value="5">Viernes</option>   
</td>
</tr>
</select>
                        <tr>
                        <th>Hora Desde</th>
                        <td>
                        <input type="time" id="f1" name="horaDesde" value=08:00>
                        </td>

                    </tr>         
                    <tr>
                        <th>Hora Hasta</th>
                        <td>
                        <input type="time" id="f1" name="horaHasta" value=08:00> 
                        </td>

                    </tr>     

                </table>
            </div>
            <div>
                <br>
                <!-- <input type="submit" value="Buscar" name="Buscar" disabled="disabled" />     -->
                <input id=buttonBuscar type="submit" value="Asignar" formaction=<?php echo $altaMateriaAProfesor?> onclick="">
                <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $menuAltaProfesor ?> /></div>
            </div>
            <div>                     
        <tr>               
                    </form>


    <footer>
        <?php require $DIR.$footer; ?>     
    </footer>  
</html>