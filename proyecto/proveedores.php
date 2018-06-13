<!DOCTYPE html>
<html lang="es">

<head>
    <!-- JAVASCRIPT -->
    <script>
        function validateForm() {
            var x = document.forms["form"]["idpro"].value;
            var y = document.forms["form"]["nombre"].value;
            if (x == "") {
                alert("Por favor, introduzca el ID del proveedor");
                return false;
            }
            if (y == "") {
                alert("Por favor, introduzca la del proveedor");
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
            $borrado = "DELETE FROM Proveedores WHERE idProv = $id";
       $borrado1 =  mysqli_query($con, $borrado);
    }
    
        
    
            if(isset($_POST['idpro'])){
            $idpro = $_POST['idpro'];
            $nombre = $_POST['nombre'];
                
            $insertar = "INSERT INTO Proveedores VALUES($idpro, '$nombre');";    
            $insertar1 = mysqli_query($con, $insertar);    
            
                /*echo $insertar;*/
    
            }
        $Registros = mysqli_query($con, "SELECT * FROM Proveedores");
		
    ?>
        <div class="container">
            <div class="table-responsive">
                <h2>Proveedores</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID del Proveedor</th>
                            <th>Nombre del Proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
		while($bucle = mysqli_fetch_array($Registros)){
			
			echo "<tr><td>".$bucle["idProv"]."</td>";
            echo "<td>".$bucle["Nombre_prov"]."</td>";
            echo "<td><a href=editar_proveedores.php?id=".$bucle['idProv'].">Editar</a>"."</td>";
			echo "<td><a href=proveedores.php?id=".$bucle['idProv'].">Eliminar</a>"."</td></tr>";
		}
        
        
	mysqli_close($con);
        ?> </tr>
                        <tr>
                    </tbody>
                </table>
            </div>
            <form name="form" class="form-inline" method="POST" action="/proveedores.php" onsubmit="return validateForm()">
                <label for="id">ID:</label>
                <input type="text" class="form-control" name="idpro">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre">
                <div class="form-check"> </div>
                <button type="submit" class="btn btn-primary">Insertar</button>
            </form>
        </div>
</body>

</html>