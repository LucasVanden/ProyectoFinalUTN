<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';

session_start();


require_once $DIR . $alumnoControlador;
require_once $DIR . $departamentoMaterias;
require_once $DIR . $controladorCambiarAula;
$depatartamentomaterias= $URL.$departamentoMaterias;
$buscarProfesoresDeMateriaSeleccionada= $URL.$buscarProfesoresDeMateriaSeleccionada;


$SeleccionEditarAulaAsignada=$URL.$SeleccionEditarAulaAsignada;




$_SESSION['Materias']=null;

$_SESSION['profesor']=null;

$a =new controladorCambiarAula();

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
    <!-- <body background=https://secure.img1-fg.wfcdn.com/im/78135171/resize-h505-w505%5Ecompr-r85/8470/84707680/Pokemon+Pikachu+Wall+Decal.jpg> -->
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        
        <script src="jquery.js"></script>
        <script src="./../js/funciones.js" type="text/javascript"></script>


        <h2>Estás cursando:</h2>
        <form action="EdistarAulaAsignada.php" method="POST">        
      
            <div>
                <br>
                <h2>Buscar Otra Consulta</h2>
                <table align='center' class="table-buscar" id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Por Profesor</th>
                        <th colspan="2">Por Materia</th>
                    </tr>
                        <tr>
                            <td>
                                <h5>Seleccione Profesor</h5>
                            </td>
                            <td colspan="2">
                                <h5>Seleccione Departamento despúes Materia</h5>
                            </td>
                        <tr>
                       
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
                            <td>                       
                                <select id="second-choice" name="Materias">
                                </select> 
                                <script>
                 $("#first-choice").change(function() {
                 $("#second-choice").load("<?php echo $depatartamentomaterias.'?choice='?>"+ $("#first-choice").val());
                }).change();</script>

                            </td>
                            <td>
                                <select id="profesor-choice" name="profesor">
                                </select>                                
                          
                            <script>
                 $("#second-choice").change(function() {
                 $("#profesor-choice").load("<?php echo $buscarProfesoresDeMateriaSeleccionada.'?choice='?>"+ $("#second-choice").val());
                }).change();</script>
                  </td>
                        </tr>                   
                </table>
            </div>
            <div>
                <br>
                <!-- <input type="submit" value="Buscar" name="Buscar" disabled="disabled" />     -->
                <input id=buttonBuscar type="submit" name="ButtonProfesor" value="Buscar Profesor" formaction=<?php echo $SeleccionEditarAulaAsignada?>>
                <input type="submit" value="Buscar Materia" name="ButtonMateria" formaction=<?php echo $SeleccionEditarAulaAsignada?>>
            </div>
            
              
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>         
    </footer>  
</html>