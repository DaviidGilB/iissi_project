DROP TABLE LíneasCompras;
DROP TABLE LíneasPedidos;
DROP TABLE Facturas;
DROP TABLE Pedidos;
DROP TABLE Contratos;
DROP TABLE MateriasPrimas;
DROP TABLE Compras;
DROP TABLE Nóminas;
DROP TABLE Transportes;
DROP TABLE Servicios;
DROP TABLE Proveedores;
DROP TABLE Trabajadores;
DROP TABLE Productos;
DROP TABLE Clientes;

CREATE TABLE Clientes(
OID_C Integer,
usuario Varchar2(30) UNIQUE NOT NULL,
contraseña Varchar(30) NOT NULL,
nombreC Varchar2(30) NOT NULL,
apellidosC Varchar2(40),
telefonoC Integer UNIQUE,
correoC Varchar2(40) UNIQUE,
direcciónC Varchar2(200),
DNI_C Char(9) UNIQUE,
CIF_C Char(9) UNIQUE,
tipoC Char(1) NOT NULL,
PRIMARY KEY (OID_C),
CONSTRAINT correoC CHECK (correoC LIKE '%@%'),
CONSTRAINT tipoC CHECK (tipoC IN('P','E')),
CONSTRAINT DNI_CIF_CLIENTES CHECK ((DNI_C IS NULL
    AND CIF_C IS NOT NULL AND tipoC LIKE 'E') OR (
    DNI_C IS NOT NULL AND CIF_C IS NULL AND tipoC LIKE 'P')),
CONSTRAINT DNI_CLIENTES CHECK (REGEXP_LIKE(dni_C, '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][A-Z]')),
CONSTRAINT CIF_CLIENTES CHECK (REGEXP_LIKE(cif_C, '[A-Z][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'))
);

CREATE TABLE Productos(
OID_PR Integer, 
nombrePR Varchar2(50) NOT NULL,
descripciónPR Varchar2(50),
trazabilidadPR Varchar2(10) NOT NULL UNIQUE,
urlFotoPR Varchar2(50) UNIQUE,
stockPR Number DEFAULT 0,
precioPR Number,
PRIMARY KEY (OID_PR),
CONSTRAINT precioPR CHECK (precioPR > 0)
);

CREATE TABLE Trabajadores(
OID_T Integer,
usuario Varchar2(30) UNIQUE NOT NULL,
contraseña Varchar(30) NOT NULL,
nombreT Varchar2(30) NOT NULL,  
apellidosT Varchar2(40),
telefonoT Integer UNIQUE,
correoT Varchar2(40) UNIQUE,
direcciónT Varchar2(200),
DNI_T Char(9) UNIQUE NOT NULL,
tipoT Char(1) NOT NULL,
PRIMARY KEY (OID_T),
CONSTRAINT correoT CHECK (correoT LIKE '%@%'),
CONSTRAINT tipoT CHECK (tipoT IN('E','J'))
);

CREATE TABLE Proveedores(
OID_PRV Integer,
nombrePRV Varchar2(30) NOT NULL,
apellidosPRV Varchar2(40),
telefonoPRV Integer UNIQUE,
correoPRV Varchar2(40) UNIQUE,
direcciónPRV Varchar2(50),
DNI_PRV Char(9) UNIQUE,
CIF_PRV Char(9) UNIQUE,
tipoPRV Char(1) NOT NULL,
PRIMARY KEY (OID_PRV),
CONSTRAINT correoPRV CHECK (correoPRV LIKE '%@%'),
CONSTRAINT tipoPRV CHECK (tipoPRV IN('A','E')),
CONSTRAINT DNI_CIF_PROVEEDORES CHECK ((DNI_PRV IS NULL
    AND CIF_PRV IS NOT NULL AND tipoPRV LIKE 'E') OR (
    DNI_PRV IS NOT NULL AND CIF_PRV IS NULL AND tipoPRV LIKE 'A')),
CONSTRAINT DNI_PROVEEDORES CHECK (REGEXP_LIKE(dni_PRV, '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][A-Z]')),
CONSTRAINT CIF_PROVEEDORES CHECK (REGEXP_LIKE(cif_PRV, '[A-Z][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'))
);

CREATE TABLE Servicios(
OID_S Integer,
nombreS Varchar2(50) NOT NULL,
descripciónS Varchar2(50),
precioS Number,
PRIMARY KEY (OID_S),
CONSTRAINT precioS CHECK (precioS > 0)
);

CREATE TABLE Transportes(
VIAJE Integer,
costeT Number DEFAULT 0,
fechaReparto Date DEFAULT SYSDATE,
OID_T Integer,
PRIMARY KEY (VIAJE),
FOREIGN KEY (OID_T) REFERENCES Trabajadores
    ON DELETE SET NULL,
CONSTRAINT costeT CHECK (costeT >= 0)
);

CREATE TABLE Nóminas(
OID_N Integer,
fechaN Date DEFAULT SYSDATE,
mesN Integer NOT NULL,
añoN Integer NOT NULL,
salarioN Number NOT NULL,
OID_T Integer,
PRIMARY KEY (OID_N),
FOREIGN KEY (OID_T) REFERENCES Trabajadores
    ON DELETE SET NULL,
CONSTRAINT mesN CHECK (mesN >= 1 AND mesN <= 12),
CONSTRAINT AÑO_NOMINAS CHECK (REGEXP_LIKE(añoN, '[0-9][0-9][0-9][0-9]'))
);

CREATE TABLE Compras(
OID_CO Integer,
fechaCO Date DEFAULT SYSDATE,
OID_T Integer,
PRIMARY KEY (OID_CO),
FOREIGN KEY (OID_T) REFERENCES Trabajadores
    ON DELETE SET NULL
);

CREATE TABLE MateriasPrimas(
OID_M Integer, 
nombreM Varchar2(50) NOT NULL,
descripciónM Varchar2(50),
trazabilidadM Varchar2(10) UNIQUE,
stockM Number DEFAULT 0,
precioM Number NOT NULL,
OID_PRV Integer,
PRIMARY KEY (OID_M),
FOREIGN KEY (OID_PRV) REFERENCES Proveedores
    ON DELETE SET NULL,
CONSTRAINT precioM CHECK (precioM > 0)
);

CREATE TABLE Contratos(
OID_CON Integer,
fechaCON Date DEFAULT SYSDATE,
fechaServicio Date,
cantidadCON Number,
horaServicio Integer,
OID_C Integer,
OID_S Integer,
PRIMARY KEY (OID_CON),
FOREIGN KEY (OID_C) REFERENCES Clientes
    ON DELETE SET NULL,
FOREIGN KEY (OID_S) REFERENCES Servicios
    ON DELETE SET NULL
);

CREATE TABLE Pedidos(
OID_P Integer,
fechaP Date DEFAULT SYSDATE,
estadoP Varchar2(18) DEFAULT 'Recibido',
OID_C Integer,
OID_T Integer,
VIAJE Integer,
PRIMARY KEY (OID_P),
FOREIGN KEY (OID_C) REFERENCES Clientes
    ON DELETE SET NULL,
FOREIGN KEY (OID_T) REFERENCES Trabajadores
    ON DELETE SET NULL,
FOREIGN KEY (VIAJE) REFERENCES Transportes
    ON DELETE SET NULL,
CONSTRAINT estadoP CHECK (estadoP IN('Recibido', 'En preparación',
    'Listo para recoger', 'En reparto', 'Entregado',
    'Entregado', 'Recogido'))
);

CREATE TABLE Facturas(
OID_F Integer,
fechaF Date DEFAULT SYSDATE,
OID_C Integer,
OID_P Integer,
OID_CON Integer,
PRIMARY KEY (OID_F),
FOREIGN KEY (OID_P) REFERENCES Pedidos
    ON DELETE SET NULL,
FOREIGN KEY (OID_CON) REFERENCES Contratos
    ON DELETE SET NULL,
CONSTRAINT OID_P_OID_CON CHECK ((OID_P IS NULL AND OID_CON IS NOT NULL)
    OR (OID_P IS NOT NULL AND OID_CON IS NULL))
);

CREATE TABLE LíneasPedidos(
OID_LP Integer,
cantidadLP Number NOT NULL,
ordenLP Integer,
OID_P Integer,
OID_PR Integer,
PRIMARY KEY (OID_LP),
FOREIGN KEY (OID_P) REFERENCES Pedidos
    ON DELETE CASCADE,
FOREIGN KEY (OID_PR) REFERENCES Productos
    ON DELETE SET NULL,
CONSTRAINT cantidadLP CHECK (cantidadLP > 0)
);

CREATE TABLE LíneasCompras(
OID_LC Integer,
cantidadLC Number NOT NULL,
ordenLC Integer NOT NULL,
OID_CO Integer,
OID_M Integer,
PRIMARY KEY (OID_LC),
FOREIGN KEY (OID_CO) REFERENCES Compras
    ON DELETE CASCADE,
FOREIGN KEY (OID_M) REFERENCES MateriasPrimas
    ON DELETE CASCADE,
CONSTRAINT cantidadLC CHECK (cantidadLC > 0)
);