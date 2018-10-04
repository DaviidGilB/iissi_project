CREATE OR REPLACE TRIGGER StockSeguridad
    BEFORE
    INSERT ON LíneasPedidos
    FOR EACH ROW
DECLARE
    cantidadTotal Number(10,2);
BEGIN
    SELECT stockPR INTO cantidadTotal FROM PRODUCTOS 
    WHERE OID_PR = :NEW.OID_PR;
    IF ((cantidadTotal - :NEW.cantidadLP) < 200)
        THEN raise_application_error
        (-20600,:new.cantidadLP||'No se puede realizar esta venta');
    END IF;
END; 

CREATE OR REPLACE TRIGGER LimiteContratos
    BEFORE
    INSERT ON Contratos
    FOR EACH ROW
DECLARE
    cantidadTotal Number(10,2);
    cantidadContrato Number(10,2) := :NEW.cantidadCON;
    cantidad Number(10,2);
BEGIN
    SELECT SUM(cantidadCON) INTO cantidadTotal FROM CONTRATOS 
    WHERE fechaServicio = :NEW.fechaServicio;
    cantidad := cantidadTotal+cantidadContrato;
    IF (cantidad > 15000)
        THEN raise_application_error
        (-20700,:new.cantidadCON||'No se pueden realizar más servicios este día');
    END IF;
END;

CREATE OR REPLACE TRIGGER CoincidenciaContratos
    BEFORE
    INSERT ON Contratos
    FOR EACH ROW
DECLARE
    cuenta Integer;
BEGIN
    SELECT COUNT(*) INTO cuenta FROM CONTRATOS
    WHERE (fechaServicio = :NEW.fechaServicio AND horaServicio = :NEW.horaServicio);
    IF (cuenta > 0)
        THEN raise_application_error
        (-20800,:new.horaServicio||'Ya existe contrato a la misma hora');
    END IF;
END;