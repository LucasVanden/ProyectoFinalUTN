
<!-- NO SE USA MAS -->
<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';

  
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);
$controladorBorrarAsueto= $URL.$controladorBorrarAsueto;
$controladorBuscarAsuetos= $URL.$controladorBuscarAsuetos;
$Menu= $URL.$AsuetoMenu;


$fechadesdeVerano="'".date("Y-m-d")."'";
$año=date('Y'); 
$buscar=false;
if(isset($_SESSION['fechasBuscadas'])){
    $buscar=true;
 }
?>

<style>
        @font-face {
  font-family: myFirstFont;
  src: url(Redemption.ttf);
}
</style>

<!DOCTYPE html>
    <head>    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Borrar Asuetos</title>
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/> 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
    <?php include  $DIR.$headerAdmin ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>             
        <form action=<?php echo $controladorBorrarAsueto ?> method="POST">
            <div class="form-group" align="center">     
                <h2 for="Asuetos" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;"> Asuetos </h2>
            </div>
            <div>
                <table align='center' class="table-mostrar" id="tablaBuscar" style="border-color: #FFFFFF">                    
                    <tr>
                        <th>Fecha Feriado</th>
                        <td>
                        <input type="date" id="f1" name="fechaAborrar" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fechadesdeVerano;?>>   
                        </td>
                    </tr>            
                </table>
            </div>
            <div class="form-group"> 
                <br> 
                <button class="btn btn-danger" name="Obtener" type="submit" formaction=<?php echo $controladorBorrarAsueto ?>> <b> -  Borrar  </b>  
                    <span class="glyphicon glyphicon-ok"></span>
                </button>                
            </div>
                <tr> <br>
                        <th> <b>Buscar Asuetos</b> </th>
                        <td>
                        <input type="number" name="año" min="1900" max="2200" step="1" value=<?php echo $año?> />
                        </td>
                        <br>

                    </tr>   

                    <br>
                    <div class="form-group" align="center"> 
                        <button class="btn btn-success" name="Buscar" type="submit" formaction=<?php echo $controladorBuscarAsuetos ?>> <b> +  Buscar Asuetos  </b>  
                            <span class="glyphicon glyphicon-ok"></span>
                        </button> 
                    </div>                     

    <?php if ($buscar): ?>
<table>

<?php
foreach ($_SESSION['fechasBuscadas'] as $fecha): ?> 
<tr>
<td>
<?php echo $fecha." "?>
<button type="submit" value=<?php echo $fecha?> name="fechaAborrar" formaction=<?php echo $controladorBorrarAsueto ?> onclick="return confirm('Esta seguro que desea eliminar fecha <?php echo $fecha?> ')"> Eliminar</button>
</td>
</tr>

<?php endforeach; ?>

</table>

     <?php endif; ?>
     </form>
    <footer>
    <?php require $DIR.$footer; ?>     
    </footer>  
</html>