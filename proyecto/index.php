<!DOCTYPE html>
<html lang="es">

<head>
    <!-- JAVASCRIPT -->
    <script>
        function validateForm() {
            var x = document.forms["form"]["ident"].value;
            var y = document.forms["form"]["direccion"].value;
            var z = document.forms["form"]["nombre"].value;
            var n = document.forms["form"]["dni"].value;
            if (x == "") {
                alert("Por favor, introduzca el ID de empleado");
                return false;
            }
            if (y == "") {
                alert("Por favor, introduzca la direccion");
                return false;
            }
            if (z == "") {
                alert("Por favor, introduzca el nombre");
                return false;
            }
            if (n == "") {
                alert("Por favor, introduzca el DNI");
                return false;
            }
            return true;
        }
    </script>
    <!-- JAVASCRIPT -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#"> <img src="icono.png" alt="logo" style="width:200px;"> </a>
        <a class="navbar-brand" href="#"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item"> <a class="nav-link" href="index.php">Empleados</a> </li>
                <li class="nav-item"> <a class="nav-link" href="pedidos.php">Pedidos</a> </li>
                <li class="nav-item"> <a class="nav-link" href="proveedores.php">Proveedores</a> </li>
                <li class="nav-item"> <a class="nav-link" href="productos.php">Productos</a> </li>
                <li class="nav-item"> <a class="nav-link" href="mesa.php">Mesas</a> </li>
            </ul>
        </div>
        <form class="form-inline" action="/action_page.php"> </form>
    </nav>
    <style>
        input {
            border: 1px solid black;
        }
        
        fieldset {
            margin-bottom: 4%;
        }
    </style>
    <?php
        
       $con = mysqli_connect("localhost", "root", "majada");
        mysqli_select_db($con, "proyecto");
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $borrado = "DELETE FROM Empleados WHERE idEmpleados = $id";
            $borrado1 =  mysqli_query($con, $borrado);
        }
        if(isset($_POST['ident'])){
            $ident = $_POST['ident'];
            $dir = $_POST['direccion'];
            $nombre = $_POST['nombre'];
            $dni = $_POST['dni'];
                
            $insertar = "INSERT INTO Empleados VALUES($ident, '$dir', '$nombre', '$dni');";    
            $insertar1 = mysqli_query($con, $insertar);    
            
            /*
                echo $insertar;
            */    
        }

        $Registros = mysqli_query($con, "SELECT * FROM Empleados");
		
    ?>
        <div class="container">
            <div class="table-responsive">
                <h2>Empleados</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID de Empleado</th>
                            <th>Direccion</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
		while($bucle = mysqli_fetch_array($Registros)){
			
			echo "<tr><td>".$bucle["idEmpleados"]."</td>";
            echo "<td>".$bucle["Direccion"]."</td>";
            echo "<td>".$bucle["Nombre"]."</td>";
            echo "<td>".$bucle["DNI"]."</td>";
            echo "<td><a href=editar_index.php?id=".$bucle['idEmpleados'].">Editar</a>"."</td>";
			echo "<td><a href=index.php?id=".$bucle['idEmpleados'].">Eliminar</a>"."</td></tr>";
		}
        
        
	mysqli_close($con);
        ?> </tr>
                    </tbody>
                </table>
            </div>
            <form name="form" class="form-inline" method="POST" action="/index.php" onsubmit="return validateForm()">
                <label for="id">ID:</label>
                <input type="text" class="form-control" name="ident">
                <label for="direccion">Direccion:</label>
                <input type="text" class="form-control" name="direccion">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre">
                <label for="dni">DNI:</label>
                <input type="text" class="form-control" name="dni">
                <div class="form-check"> </div>
                <button type="submit" class="btn btn-primary">Insertar</button>
            </form>
        </div>
</body>

</html>