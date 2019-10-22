

<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR . $Materia);

$con= new conexion();
$conexttion=$con->getconexion();
 
$conn = $conexttion;
if (isset($_GET['choice'])){
    $choice = $_GET['choice'];
    $stmt = $conn->prepare("SELECT fk_materia,fk_dedicacion FROM dedicacion_materia_profesor where fk_profesor='$choice' and eliminado is NULL "); 
    $stmt->execute();

    while($row = $stmt->fetch()) {
        $materia= $row['fk_materia'];
        $stmt2 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$materia"); 
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $mat = new Materia();
            $mat->setid_materia($row['id_materia']);
            $mat->setnombreMateria($row['nombreMateria']);
        }
        echo "<option value=" . $mat->getid_materia().">" . $mat->getnombreMateria() . "</option>";
    }
 }
?>