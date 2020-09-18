/*Creacion base de datos*/
create database puestofit
    default character set utf8;

/*Creacion de Tablas*/
use puestofit;

create table inventario (
	cod_prod int not null unique auto_increment,
	nombre varchar(255) null,
	existencia varchar(255) null,
    cantidad_min int null,
    marca varchar(255) null,
    categoria varchar (255) null,
    precio_compra int null,
    precio_venta int,
    contiene_T varchar(2),
    contiene_A varchar(2),
    contiene_L varchar(2),
    descripcion varchar (255),
	fecha_registro datetime null,
    cod_prov int,
    cod_deposito int,
	primary key(cod_prod)
);

create table proveedores (
    cod_prov int not null unique auto_increment,
    cuil int null,
    nombre varchar(255) null,
    direccion varchar(255)  null,
    telefono int,
    email varchar(255),
    primary key (cod_prov)
);


create table depositos (
    cod_deposito int not null unique auto_increment,
    nombre varchar(255) null,
    direccion varchar(255)  null,
    primary key (cod_deposito)
);

create table stock_deposito (
    cod_deposito int,
    cod_prod int,
    cantidad int,
    primary key(cod_prod,cod_deposito)
);

create table pedidos_reposicion(
    cod_pedido int unique auto_increment,
    fecha datetime,
    estado int,
    primary key(cod_pedido) 
);

create table detalle_pedidos_reposicion(
    cod_det_pedido int unique auto_increment,
    cod_pedido int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    observaciones varchar(255),
    primary key (cod_det_pedido),
    FOREIGN key (cod_pedido) REFERENCES pedidos_reposicion(cod_pedido) ON DELETE CASCADE
);

create table cotizaciones(
    cod_cotizacion int unique auto_increment,
    cod_pedido int,
    fecha_emision datetime,
    fecha_presupuesto datetime,
    proveedor varchar(255),
    total int,
    estado int,
    primary key(cod_cotizacion),
    FOREIGN key (cod_pedido) REFERENCES pedidos_reposicion(cod_pedido) ON DELETE CASCADE 
);

create table detalle_cotizacion(
    cod_det_cotizacion int unique auto_increment,
    cod_cotizacion int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    precio_unitario int,
    primary key (cod_det_cotizacion),
    FOREIGN key (cod_cotizacion) REFERENCES cotizaciones(cod_cotizacion) on DELETE CASCADE
);

create table ordenes_de_compra(
    cod_orden_de_compra int unique auto_increment,
    fecha_emision datetime,
    fecha_entrega_estimada datetime,
    proveedor varchar(255),
    total int,
    estado varchar(100),
    primary key(cod_orden_de_compra),
    cod_cotizacion int,
    FOREIGN key (cod_cotizacion) REFERENCES cotizaciones(cod_cotizacion) ON DELETE CASCADE 
);

create table detalle_ordenes_de_compra(
    cod_det_orden_de_compra int unique auto_increment,
    cod_orden_de_compra int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    precio_unitario int,
    primary key (cod_det_orden_de_compra),
    FOREIGN key (cod_orden_de_compra) REFERENCES ordenes_de_compra(cod_orden_de_compra) on DELETE CASCADE
);

create table facturas_compra(
    cod_factura_compra int unique auto_increment,
    fecha datetime,
    fecha_entrega_estimada datetime,
    proveedor varchar(255),
    total int,
    estado varchar(100),
    primary key(cod_factura_compra),
    cod_oc int,
    FOREIGN key (cod_oc) REFERENCES ordenes_de_compra(cod_orden_de_compra) ON DELETE CASCADE 
);

create table detalle_facturas_compra(
    cod_det_factura_compra int unique auto_increment,
    cod_factura_compra int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    precio_unitario int,
    primary key (cod_det_factura_compra),
    FOREIGN key (cod_factura_compra) REFERENCES facturas_compra(cod_factura_compra) on DELETE CASCADE
);

create table remitos(
    cod_remito int unique auto_increment,
    fecha datetime,
    proveedor varchar(255),
    total int,
    estado varchar(100),
    primary key(cod_remito),
    cod_factura int,
    FOREIGN key (cod_factura) REFERENCES facturas_compra(cod_factura_compra) ON DELETE CASCADE 
);

create table detalle_remitos(
    cod_det_remito int unique auto_increment,
    cod_remito int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    precio_unitario int,
    primary key (cod_det_remito),
    FOREIGN key (cod_remito) REFERENCES remitos(cod_remito) on DELETE CASCADE
);

/* Claves*/

ALTER TABLE stock_deposito ADD CONSTRAINT FK_stock_cod_deposito FOREIGN KEY(cod_deposito) REFERENCES depositos(cod_deposito);
ALTER TABLE stock_deposito ADD CONSTRAINT FK_stock_cod_prod FOREIGN KEY(cod_prod) REFERENCES inventario(cod_prod);
ALTER TABLE inventario ADD CONSTRAINT FK_inventario_proveedor FOREIGN KEY(cod_prov) REFERENCES proveedores(cod_prov);
ALTER TABLE inventario ADD CONSTRAINT FK_inventario_depostios FOREIGN KEY(cod_deposito) REFERENCES depositos(cod_deposito);

/*VISTAS*/
CREATE VIEW vista_productos_por_deposito AS
SELECT inventario.cod_prod, inventario.nombre as 'nom_producto' /*Etc para todo lo que necesites de inventarios*/
deposito.nombre as 'nom_deposito', /*Etc para todo lo que necesites de depositos*/
stock_deposito.cantidad /*de aqui solo la cantidad, el resto se usa para unir las otras dos*/
from inventario
INNER JOIN stock_deposito
on  inventario.cod_prod = stock_deposito.cod_prod
INNER JOIN deposito
on stock_deposito.cod_deposito = deposito.cod_deposito



select * from vista_productos_por_deposito
/*Carga de elementos*/
    /*Carga de proveedores*/
    insert into proveedores (cuil,nombre,direccion,telefono,email)
    values(1231242,'Arcor','Caseros 1250',4324598,'arcor@gmail.com'),
          (9536478,'Coca-Cola Company','Paraguay 2250',4243017,'coca-cola@gmail.com'),
          (4487951,'Palacio de las golosinas','Pellegrini 742',3874923654,'epdlg@gmail.com');
          
    /*Carga de depositos*/
    insert into depositos (nombre,direccion)
    values('Santa ana','B° Santa Ana Manzana 20 Casa 5'),
    ('Tres Cerritos','Las Acacias 1268'),
    ('Centro','San Martín 788');
    
    /*Carga tabla inventario*/
    insert into inventario (nombre,existencia,cantidad_min,marca,categoria,precio_compra,precio_venta,
                        	contiene_T,contiene_A,contiene_L,descripcion,fecha_registro,cod_prov,cod_deposito)
    values('Semillas de chia x 100grs',20,10,'Chiamix','Semillas','5','7','no','no','no','Ricas en proteinas!',NOW(),1,1),
          ('Barra de cereal',30,10,'CerealMix','Barras de cereal','4','7','si','si','no',null,NOW(),3,1),
          ('Galletas dulces',40,15,'Frutigram','Galletas','8','14','si','si','no','Lo mejor del mercado!',NOW(),2,1),
          ('Leche de coco x 1lt',5,10,'Ades','Bebidas','10','20','no','no','no','Muy natural',NOW(),3,2);
    
