<!DOCTYPE html>
<html lang="es">

<head>
    <!-- JAVASCRIPT -->
    <script>
        function validateForm() {
            var x = document.forms["form"]["nmesa"].value;
            var y = document.forms["form"]["ncom"].value;
            if (x == "") {
                alert("Por favor, introduzca el numero de mesa");
                return false;
            }
            if (y == "") {
                alert("Por favor, introduzca de comensales");
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
            $borrado = "DELETE FROM Mesa WHERE nº_mesa = $id";
       $borrado1 =  mysqli_query($con, $borrado);
    }
        $Registros = mysqli_query($con, "SELECT * FROM Mesa");
		
    
    
            if(isset($_POST['nmesa'])){
            $nmesa = $_POST['nmesa'];
            $ncom = $_POST['ncom'];
                
            $insertar = "INSERT INTO Mesa VALUES($nmesa, $ncom);";    
            $insertar1 = mysqli_query($con, $insertar);    
            
                /*echo $insertar;*/
    
            }
    ?>
        <div class="container">
            <div class="table-responsive">
                <h2>Productos</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nº de mesa</th>
                            <th>Nº de comensales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
		while($bucle = mysqli_fetch_array($Registros)){
			
			echo "<tr><td>".$bucle["nº_mesa"]."</td>";
            echo "<td>".$bucle["nº_comensales"]."</td>";
            echo "<td><a href=editar_mesa.php?id=".$bucle['nº_mesa'].">Editar</a>"."</td>";
			echo "<td><a href=mesa.php?id=".$bucle['nº_mesa'].">Eliminar</a>"."</td></tr>";
			
		}
        
        
	mysqli_close($con);
        ?> </tr>
                        <tr>
                    </tbody>
                </table>
            </div>
            <form name="form" class="form-inline" method="POST" action="/mesa.php" onsubmit="return validateForm()">
                <label for="nmesa">Nº de mesa:</label>
                <input type="text" class="form-control" name="nmesa">
                <label for="ncom">Nº de comensales:</label>
                <input type="text" class="form-control" name="ncom">
                <div class="form-check"> </div>
                <button type="submit" class="btn btn-primary">Insertar</button>
            </form>
        </div>
</body>

</html>