<!DOCTYPE html>
<html lang="es">

<head>
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
    		
    

        if(isset($_REQUEST['idprod'])){
            $precio = $_REQUEST['precio'];
            $id = $_REQUEST['idprod'];
                
            $editar = "UPDATE Productos SET Precio = $precio WHERE idProductos = $id";    
            $editar1 = mysqli_query($con, $editar);    
            
            
                   

        }
    else $id = $_REQUEST['id'];   

               
            $Registros = mysqli_query($con, "SELECT * FROM Productos where idProductos = '$id'");
            $bucle = mysqli_fetch_array($Registros);      
    
    
    ?>
        <div class="container">
            <div class="table-responsive">
                <h2>Productos</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID del Producto</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
		
			
			echo "<tr><td>".$bucle["idProductos"]."</td>";
            echo "<td>".$bucle["Precio"]."€"."</td></tr>";
		
        
        
	mysqli_close($con);
        ?> </tr>
                        <tr>
                    </tbody>
                </table>
            </div>
        </div>
        <h1>Editar Productos</h1>
        <form class="form-inline" method="POST" action="/editar_productos.php">
            <fieldset>
                <input type="hidden" name="idprod" value="<?php echo $id ?>" required>
                <br/>
                <label for="precio">Precio:</label>
                <input type="text" name="precio" value="<?php echo $bucle['Precio'] ?>" required>
                <br/> </fieldset>
            <br>
            <input type="submit" value="Editar" /> </form>
</body>

</html>