<?php
session_start();
if (isset($_SESSION['user_id'])) {
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
    <body background = <?php echo $URL.$fondo?>>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>

        <?php $nommat= $_POST['nombreMateriaSeleccionada'];
           $a=new profesorControlador();
           $idmateria= $a->buscarIDdeNombreMateria($nommat);
           $dedicacion=$a->buscarDedicaciondeMateria($idmateria,2)//id PROFESOR SESSION<---------------------------------------------------------------------------------------------
           ?>
        <h2>Establecer Horario de Consulta:</h2>
        <form action="alumnoPpal.php" method="POST">
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Nombre</th>
                        <td>
                           <?php echo $_POST['nombreMateriaSeleccionada']?>
<!--                            <select name="Materias">                       
                                <option>Administración de Recursos</option>
                                <option>Administración Gerencial</option>
                            </select> -->
                        </td>
                    </tr>
                    <tr>
                        <th>Dedicación</th>
                        <td>
                        <?php echo $dedicacion->gettipo()?>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Primer Semestre</th>
                    </tr>
                    <tr>
                        <th>Día</th>
                        <td>
                            <select name="Dias">                       
                                <option value=1>Lunes</option>
                                <option value=2>Martes</option>
                                <option value=3>Miércoles</option>
                                <option value=4>Jueves</option>
                                <option value=5>Viernes</option>
                            </select>
                        </td>
                        <td>
                            <select name="Dias">                       
                                <option value=1>Lunes</option>
                                <option value=2>Martes</option>
                                <option value=3>Miércoles</option>
                                <option value=4>Jueves</option>
                                <option value=5>Viernes</option>
                            </select>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Horario</th>                        
                        <td>
                            <select name="Horarios">                       
                                <option value='8:00'>8:00</option>
                                <option value='8:30'>8:30</option>
                                <option value='9:00'>9:00</option>
                                <option value='9:30'>9:30</option>
                                <option value='10:00'>10:00</option>
                                <option value='10:30'>10:30</option>
                                <option value='11:00'>11:00</option>
                                <option value='11:30'>11:30</option>
                                <option value='12:00'>12:00</option>
                                <option value='12:30'>12:30</option>
                                <option value='13:00'>13:00</option>
                                <option value='13:30'>13:30</option>
                                <option value='14:00'>14:00</option>
                                <option value='14:30'>14:30</option>
                                <option value='15:00'>15:00</option>
                                <option value='15:30'>15:30</option>
                                <option value='16:00'>16:00</option>
                                <option value='16:30'>16:30</option>
                                <option value='17:00'>17:00</option>
                                <option value='17:30'>17:30</option>
                                <option value='18:00'>18:00</option>
                                <option value='18:30'>18:30</option>
                                <option value='19:00'>19:00</option>
                                <option value='19:30'>19:30</option>
                                <option value='20:00'>20:00</option>
                                <option value='20:30'>20:30</option>
                                <option value='21:00'>21:00</option>
                                <option value='21:30'>21:30</option>
                                <option value='22:00'>22:00</option>
                            </select>
                        </td>
                        <td>
                            <select name="Horarios">                       
                                <option value='8:00'>8:00</option>
                                <option value='8:30'>8:30</option>
                                <option value='9:00'>9:00</option>
                                <option value='9:30'>9:30</option>
                                <option value='10:00'>10:00</option>
                                <option value='10:30'>10:30</option>
                                <option value='11:00'>11:00</option>
                                <option value='11:30'>11:30</option>
                                <option value='12:00'>12:00</option>
                                <option value='12:30'>12:30</option>
                                <option value='13:00'>13:00</option>
                                <option value='13:30'>13:30</option>
                                <option value='14:00'>14:00</option>
                                <option value='14:30'>14:30</option>
                                <option value='15:00'>15:00</option>
                                <option value='15:30'>15:30</option>
                                <option value='16:00'>16:00</option>
                                <option value='16:30'>16:30</option>
                                <option value='17:00'>17:00</option>
                                <option value='17:30'>17:30</option>
                                <option value='18:00'>18:00</option>
                                <option value='18:30'>18:30</option>
                                <option value='19:00'>19:00</option>
                                <option value='19:30'>19:30</option>
                                <option value='20:00'>20:00</option>
                                <option value='20:30'>20:30</option>
                                <option value='21:00'>21:00</option>
                                <option value='21:30'>21:30</option>
                                <option value='22:00'>22:00</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Segundo Semestre</th>
                    </tr>
                    <tr>
                        <th>Día</th>
                        <td>
                            <select name="Dias">                       
                                <option value=1>Lunes</option>
                                <option value=2>Martes</option>
                                <option value=3>Miércoles</option>
                                <option value=4>Jueves</option>
                                <option value=5>Viernes</option>
                            </select>
                        </td>
                        <td>
                            <select name="Dias">                       
                                <option value=1>Lunes</option>
                                <option value=2>Martes</option>
                                <option value=3>Miércoles</option>
                                <option value=4>Jueves</option>
                                <option value=5>Viernes</option>
                            </select>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Horario</th>                        
                        <td>
                            <select name="Horarios">                       
                                <option value='8:00'>8:00</option>
                                <option value='8:30'>8:30</option>
                                <option value='9:00'>9:00</option>
                                <option value='9:30'>9:30</option>
                                <option value='10:00'>10:00</option>
                                <option value='10:30'>10:30</option>
                                <option value='11:00'>11:00</option>
                                <option value='11:30'>11:30</option>
                                <option value='12:00'>12:00</option>
                                <option value='12:30'>12:30</option>
                                <option value='13:00'>13:00</option>
                                <option value='13:30'>13:30</option>
                                <option value='14:00'>14:00</option>
                                <option value='14:30'>14:30</option>
                                <option value='15:00'>15:00</option>
                                <option value='15:30'>15:30</option>
                                <option value='16:00'>16:00</option>
                                <option value='16:30'>16:30</option>
                                <option value='17:00'>17:00</option>
                                <option value='17:30'>17:30</option>
                                <option value='18:00'>18:00</option>
                                <option value='18:30'>18:30</option>
                                <option value='19:00'>19:00</option>
                                <option value='19:30'>19:30</option>
                                <option value='20:00'>20:00</option>
                                <option value='20:30'>20:30</option>
                                <option value='21:00'>21:00</option>
                                <option value='21:30'>21:30</option>
                                <option value='22:00'>22:00</option>
                            </select>
                        </td>
                        <td>
                            <select name="Horarios">                       
                                <option value='8:00'>8:00</option>
                                <option value='8:30'>8:30</option>
                                <option value='9:00'>9:00</option>
                                <option value='9:30'>9:30</option>
                                <option value='10:00'>10:00</option>
                                <option value='10:30'>10:30</option>
                                <option value='11:00'>11:00</option>
                                <option value='11:30'>11:30</option>
                                <option value='12:00'>12:00</option>
                                <option value='12:30'>12:30</option>
                                <option value='13:00'>13:00</option>
                                <option value='13:30'>13:30</option>
                                <option value='14:00'>14:00</option>
                                <option value='14:30'>14:30</option>
                                <option value='15:00'>15:00</option>
                                <option value='15:30'>15:30</option>
                                <option value='16:00'>16:00</option>
                                <option value='16:30'>16:30</option>
                                <option value='17:00'>17:00</option>
                                <option value='17:30'>17:30</option>
                                <option value='18:00'>18:00</option>
                                <option value='18:30'>18:30</option>
                                <option value='19:00'>19:00</option>
                                <option value='19:30'>19:30</option>
                                <option value='20:00'>20:00</option>
                                <option value='20:30'>20:30</option>
                                <option value='21:00'>21:00</option>
                                <option value='21:30'>21:30</option>
                                <option value='22:00'>22:00</option>
                            </select>
                        </td>
                    </tr>                   
                </table>
            </div>
            <div>
                <br>
                <input type='hidden' value=<?php echo $idmateria?>></input>
                <input type="submit" value="Establecer" name="Establecer" disabled="disabled" />
            </div>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>   
    </footer>  
</html>