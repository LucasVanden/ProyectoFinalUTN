<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . $profesorControlador;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Estás Dictando:</h2>
        <form action="profesorPpal.php" method="POST">        
            <div>
            <table align='center' class="table-mostrar" id="tablaMateria">
                    <thead>
                        <!--aca va cabecera de tabla-->
                    </thead>
                    <tbody>
                        <tr>
                            <th> Materias </th>
                        </tr>
                        <?php 
                        $a =new profesorControlador ;
                        $listaDedicaciones = $a->buscarMateriasProfesor(02);
                        foreach ($listaDedicaciones as $dedicacion): ?> 
                      
                            <tr>
                           <td> 
                           <input type="submit" name="nombreMateriaSeleccionada" id='<?php echo $dedicacion->getid_dedicacion()?>'  value="<?php echo $dedicacion->getMateria()->getnombreMateria()?>" formaction="profesorEstablecerHorario.php" 
                            onclick=""></input></td>
                             </tr>
                        <?php endforeach; 
                            ?>
                    </tbody>
                </table>
            </div>            
            <h2>Establecer Horario de Consulta:</h2>
            <table>
                <thead>
                    
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="MateriasDictando">                      
                                <option>Administración de Recursos</option>
                                <option>Administración Gerencial</option>
                            </select> 
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>                
                <h2>Alumnos Anotados</h2>
                <div>
                    <table id="tablaAlumnosAnotados" onclick="">
                        <thead>
                        <th>Materia</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Cantidad</th>
                        <th>Notificar</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Administración Gerencial
                                </td>
                                <td>
                                    Jueves
                                </td>
                                <td>
                                    17:30
                                </td>
                                <td>
                                    4
                                </td>
                                <td>
                                    <button id="buttonNotificar" name="Notificar"> Notificar </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Administración de Recursos
                                </td>                                
                                <td>
                                    Martes
                                </td>
                                <td>
                                    19:00
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    <button id="buttonNotificar" name="Notificar"> Notificar </button>
                                </td>
                            </tr>                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <h2>Mis Notificaciones</h2>
                <h4> Usted no tiene Mensajes Nuevos</h4>
            </div>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>      
    </footer>  
</html>