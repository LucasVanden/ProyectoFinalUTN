<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';

session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if(!in_array(5,$_SESSION['permisos'])){
        header('location: '. $URL.$login);
    }
  }
  

require_once $DIR . $alumnoControlador;
require_once $DIR . $departamentoMaterias;
require_once $DIR . $controladorAdministrador;
$buscarDepartamentosconel1erovacio= $URL.$buscarDepartamentosconel1erovacio;
$buscarProfesoresDeMateriaSeleccionada= $URL.$buscarProfesoresDeMateriaSeleccionada;


$SeleccionEditarAulaAsignada=$URL.$SeleccionEditarAulaAsignada;




$_SESSION['Materias']=null;

$_SESSION['profesor']=null;

$a =new controladorAdministrador();

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
    <!-- <body background=https://secure.img1-fg.wfcdn.com/im/78135171/resize-h505-w505%5Ecompr-r85/8470/84707680/Pokemon+Pikachu+Wall+Decal.jpg> -->
    <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        
        <script src="jquery.js"></script>
        <script src="./../js/funciones.js" type="text/javascript"></script>


        <h2>Editar Aula Asignada:</h2>
        <form action="EdistarAulaAsignada.php" method="POST">        
      
            <div>
         
                <table align='center' class="table-buscar" id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Departamento</th>
                        <th>Materia</th>
                        <th>Profesor</th>
                    </tr>
                       
                       
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
                 $("#second-choice").load("<?php echo $buscarDepartamentosconel1erovacio.'?choice='?>"+ $("#first-choice").val());
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
                <input id=buttonBuscar type="submit" name="ButtonProfesor" value="Aceptar" formaction=<?php echo $SeleccionEditarAulaAsignada?>>
             
            </div>
            
              
        </form>
    </body>
    <footer>
    <?php require $DIR.$footer; ?>           
    </footer>  
</html>