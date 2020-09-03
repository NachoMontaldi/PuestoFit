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
    contiene_T boolean,
    contiene_A boolean,
    contiene_L boolean,
    descripcion varchar (255),
	fecha_registro datetime null,
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

/*Carga de elementos*/

    /*Carga tabla inventario*/
    insert into inventario (nombre,existencia,cantidad_min,marca,categoria,precio_compra,precio_venta,
                        	contiene_T,contiene_A,contiene_L,descripcion,fecha_registro)
    values('Semillas de chia x 100grs',20,10,'Chiamix','Semillas','5','7',0,0,0,null,NOW()),
          ('Barra de cereal',30,10,'CerealMix','Barras de cereal','4','7',1,1,0,null,NOW()),
          ('Galletas dulces',40,15,'Frutigram','Galletas','8','14',1,1,0,null,NOW()),
          ('Leche de coco x 1lt',5,10,'Ades','Bebidas','10','20',0,0,0,null,NOW())
    );