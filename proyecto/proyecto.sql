DROP DATABASE IF EXISTS proyecto;
CREATE DATABASE proyecto;
USE proyecto;
	

CREATE TABLE IF NOT EXISTS Empleados (
  idEmpleados INT  NOT NULL,
  Direccion VARCHAR(45),
  Nombre VARCHAR(45),
  DNI CHAR(9) NOT NULL,
  PRIMARY KEY (idEmpleados)
  );

CREATE TABLE IF NOT EXISTS Pedido (
  idPedido INT NOT NULL,
  Fecha_envio TIMESTAMP,
  Fecha_llegada TIMESTAMP CHECK(Fecha_llegada > Fecha_envio),
  Empleados_idEmpleados INT,
  PRIMARY KEY (idPedido, Empleados_idEmpleados),
  CONSTRAINT fk_Pedido_Empleados1
    FOREIGN KEY (Empleados_idEmpleados)
    REFERENCES Empleados (idEmpleados)
	ON DELETE CASCADE
    ON UPDATE CASCADE
    );


CREATE TABLE IF NOT EXISTS Proveedores (
  idProv INT NOT NULL ,
  Nombre_prov VARCHAR(45) ,
  PRIMARY KEY (idProv)
  );


CREATE TABLE IF NOT EXISTS Productos (
  idProductos INT NOT NULL ,
  Precio DECIMAL NOT NULL CHECK(Precio > 0),
  PRIMARY KEY (idProductos)
  );


CREATE TABLE IF NOT EXISTS Comanda (
  idComanda INT  NOT NULL,
  PRIMARY KEY (idComanda)
  );


CREATE TABLE IF NOT EXISTS Mesa (
  nº_mesa INT NOT NULL CHECK(nº_mesa BETWEEN 1 AND 10),
  nº_comensales VARCHAR(45) CHECK(nº_comensales BETWEEN 1 AND 4),
  PRIMARY KEY (nº_mesa)
  );


CREATE TABLE IF NOT EXISTS tiene (
  Productos_idProductos INT NOT NULL ,
  Pedido_idPedido INT NOT NULL ,
  Proveedores_idProv INT NOT NULL ,
  Cantidad_prov INT CHECK(Cantidad_prov > 1),
  PRIMARY KEY (Productos_idProductos, Pedido_idPedido),
  CONSTRAINT fk_Productos_has_Pedido_Productos
    FOREIGN KEY (Productos_idProductos)
    REFERENCES Productos (idProductos)
	ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_Productos_has_Pedido_Pedido1
    FOREIGN KEY (Pedido_idPedido)
    REFERENCES Pedido (idPedido)
	ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_Productos_has_Pedido_Proveedores1
    FOREIGN KEY (Proveedores_idProv)
    REFERENCES Proveedores (idProv)
	ON DELETE CASCADE
    ON UPDATE CASCADE
  );


CREATE TABLE IF NOT EXISTS Camarero (
  Empleados_idEmpleados INT NOT NULL,
  PRIMARY KEY (Empleados_idEmpleados),
  CONSTRAINT fk_Camarero_Empleados1
    FOREIGN KEY (Empleados_idEmpleados)
    REFERENCES Empleados (idEmpleados)
	ON DELETE CASCADE
    ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS Cocinero (
  Empleados_idEmpleados INT  NOT NULL,
  PRIMARY KEY (Empleados_idEmpleados),
  CONSTRAINT fk_Cocinero_Empleados1
    FOREIGN KEY (Empleados_idEmpleados)
    REFERENCES Empleados (idEmpleados)
	ON DELETE CASCADE
    ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS atiende (
  Comanda_idComanda INT  NOT NULL,
  Mesa_nº_mesa INT  NOT NULL,
  Camarero_Empleados_idEmpleados INT NOT NULL,
  Fecha_hora DATETIME,
  PRIMARY KEY (Comanda_idComanda),
  CONSTRAINT fk_atiende_Comanda1
    FOREIGN KEY (Comanda_idComanda)
    REFERENCES Comanda (idComanda)
	ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_atiende_Mesa1
    FOREIGN KEY (Mesa_nº_mesa)
    REFERENCES Mesa (nº_mesa)
	ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_atiende_Camarero1
    FOREIGN KEY (Camarero_Empleados_idEmpleados)
    REFERENCES Camarero (Empleados_idEmpleados)
	ON DELETE CASCADE
    ON UPDATE CASCADE
    );


CREATE TABLE IF NOT EXISTS contiene (
  Productos_idProductos INT NOT NULL,
  Comanda_idComanda INT NOT NULL,
  Cantidad_com INT CHECK(Cantidad_com >= 1),
  PRIMARY KEY (Productos_idProductos, Comanda_idComanda),
  CONSTRAINT fk_contiene_Productos1
    FOREIGN KEY (Productos_idProductos)
    REFERENCES Productos (idProductos)
	ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_contiene_Comanda1
    FOREIGN KEY (Comanda_idComanda)
    REFERENCES Comanda (idComanda)
	ON DELETE CASCADE
    ON UPDATE CASCADE
    );


CREATE TABLE IF NOT EXISTS Platos (
  Productos_idProductos INT NOT NULL,
  PRIMARY KEY (Productos_idProductos),
  CONSTRAINT fk_Platos_Productos1
    FOREIGN KEY (Productos_idProductos)
    REFERENCES Productos (idProductos)
	ON DELETE CASCADE
    ON UPDATE CASCADE
    );


CREATE TABLE IF NOT EXISTS Bebidas (
  Productos_idProductos INT NOT NULL,
  Marca VARCHAR(45) ,
  Mayor_18 ENUM('Si', 'No') ,
  PRIMARY KEY (Productos_idProductos),
  CONSTRAINT fk_Bebidas_Productos1
    FOREIGN KEY (Productos_idProductos)
    REFERENCES Productos (idProductos)
	ON DELETE CASCADE
    ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS EmpTelefono (
  Empleados_idEmpleados INT NOT NULL,
  Telefono_emp CHAR(9) NOT NULL,
  PRIMARY KEY (Empleados_idEmpleados, Telefono_emp),
  CONSTRAINT fk_table1_Empleados1
    FOREIGN KEY (Empleados_idEmpleados)
    REFERENCES Empleados (idEmpleados)
	ON DELETE CASCADE
    ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS ProvTelefono (
  Proveedores_idProv INT NOT NULL ,
  Telefono_prov CHAR(9) NOT NULL ,
  PRIMARY KEY (Proveedores_idProv, Telefono_prov),
  CONSTRAINT fk_table1_Proveedores1
    FOREIGN KEY (Proveedores_idProv)
    REFERENCES Proveedores (idProv)
	ON DELETE CASCADE
    ON UPDATE CASCADE
    );


CREATE TABLE IF NOT EXISTS IngPlatos (
  Platos_Productos_idProductos INT NOT NULL,
  Ingredientes VARCHAR(45) NOT NULL,
  PRIMARY KEY (Platos_Productos_idProductos, Ingredientes),
  CONSTRAINT fk_IngPlatos_Platos1
    FOREIGN KEY (Platos_Productos_idProductos)
    REFERENCES Platos (Productos_idProductos)
	ON DELETE CASCADE
    ON UPDATE CASCADE
);

