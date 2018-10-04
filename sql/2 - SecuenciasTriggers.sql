DROP SEQUENCE genera_oid_clientes;
DROP SEQUENCE genera_oid_pedidos;
DROP SEQUENCE genera_oid_facturas;
DROP SEQUENCE genera_oid_transportes;
DROP SEQUENCE genera_oid_lineaspedidos;
DROP SEQUENCE genera_oid_productos;
DROP SEQUENCE genera_oid_nominas;
DROP SEQUENCE genera_oid_compras;
DROP SEQUENCE genera_oid_trabajadores;
DROP SEQUENCE genera_oid_lineascompras;
DROP SEQUENCE genera_oid_materiasprimas;
DROP SEQUENCE genera_oid_proveedores;
DROP SEQUENCE genera_oid_contratos;
DROP SEQUENCE genera_oid_servicios;

CREATE SEQUENCE genera_oid_clientes;
CREATE SEQUENCE genera_oid_pedidos;
CREATE SEQUENCE genera_oid_facturas;
CREATE SEQUENCE genera_oid_transportes;
CREATE SEQUENCE genera_oid_lineaspedidos;
CREATE SEQUENCE genera_oid_productos;
CREATE SEQUENCE genera_oid_nominas;
CREATE SEQUENCE genera_oid_compras;
CREATE SEQUENCE genera_oid_trabajadores;
CREATE SEQUENCE genera_oid_lineascompras;
CREATE SEQUENCE genera_oid_materiasprimas;
CREATE SEQUENCE genera_oid_proveedores;
CREATE SEQUENCE genera_oid_contratos;
CREATE SEQUENCE genera_oid_servicios;

CREATE OR REPLACE TRIGGER crea_oid_clientes
BEFORE INSERT ON Clientes
FOR EACH ROW
BEGIN
    SELECT genera_oid_clientes.NEXTVAL INTO :NEW.OID_C FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_pedidos
BEFORE INSERT ON Pedidos
FOR EACH ROW
BEGIN
    SELECT genera_oid_pedidos.NEXTVAL INTO :NEW.OID_P FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_facturas
BEFORE INSERT ON Facturas
FOR EACH ROW
BEGIN
    SELECT genera_oid_facturas.NEXTVAL INTO :NEW.OID_F FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_transportes
BEFORE INSERT ON Transportes
FOR EACH ROW
BEGIN
    SELECT genera_oid_transportes.NEXTVAL INTO :NEW.VIAJE FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_lineaspedidos
BEFORE INSERT ON LíneasPedidos
FOR EACH ROW
BEGIN
    SELECT genera_oid_lineaspedidos.NEXTVAL INTO :NEW.OID_LP FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_productos
BEFORE INSERT ON Productos
FOR EACH ROW
BEGIN
    SELECT genera_oid_productos.NEXTVAL INTO :NEW.OID_PR FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_nominas
BEFORE INSERT ON Nóminas
FOR EACH ROW
BEGIN
    SELECT genera_oid_nominas.NEXTVAL INTO :NEW.OID_N FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_compras
BEFORE INSERT ON Compras
FOR EACH ROW
BEGIN
    SELECT genera_oid_compras.NEXTVAL INTO :NEW.OID_CO FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_trabajadores
BEFORE INSERT ON Trabajadores
FOR EACH ROW
BEGIN
    SELECT genera_oid_trabajadores.NEXTVAL INTO :NEW.OID_T FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_lineascompras
BEFORE INSERT ON LíneasCompras
FOR EACH ROW
BEGIN
    SELECT genera_oid_lineascompras.NEXTVAL INTO :NEW.OID_LC FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_materiasprimas
BEFORE INSERT ON MateriasPrimas
FOR EACH ROW
BEGIN
    SELECT genera_oid_materiasprimas.NEXTVAL INTO :NEW.OID_M FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_proveedores
BEFORE INSERT ON Proveedores
FOR EACH ROW
BEGIN
    SELECT genera_oid_proveedores.NEXTVAL INTO :NEW.OID_PRV FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_contratos
BEFORE INSERT ON Contratos
FOR EACH ROW
BEGIN
    SELECT genera_oid_contratos.NEXTVAL INTO :NEW.OID_CON FROM DUAL;
END;

CREATE OR REPLACE TRIGGER crea_oid_servicios
BEFORE INSERT ON Servicios
FOR EACH ROW
BEGIN
    SELECT genera_oid_servicios.NEXTVAL INTO :NEW.OID_S FROM DUAL;
END;