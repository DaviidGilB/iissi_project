INSERT INTO CLIENTES(usuario, contrase�a, nombreC,
    apellidosC, telefonoC, correoC, direcci�nC,
    DNI_C, CIF_C, tipoC) VALUES('DEFENSA', 'defensa',
    'Cliente', 'IISSI', 123456789, 'cliente@iissi.com',
    'Sevilla ETSII', '12345678X', null, 'P');
    
INSERT INTO PRODUCTOS(nombrePR, descripci�nPR, trazabilidadPR,
    urlFotoPR, stockPR, precioPR) VALUES('Garbanzo Gordo',
    'Bolsa 1Kg. Procedencia USA. Gran calidad', 'GG2030', 
    'images/garbanzo_gordo.jpg', 2500, 1.1);
INSERT INTO PRODUCTOS(nombrePR, descripci�nPR, trazabilidadPR,
    urlFotoPR, stockPR, precioPR) VALUES('Alubia Blanca',
    'Bolsa 1Kg. Procedencia Canad�. Gran calidad', 'AB2040', 
    'images/alubia_blanca_ri�on.jpg', 3000, 1.9);
INSERT INTO PRODUCTOS(nombrePR, descripci�nPR, trazabilidadPR,
    urlFotoPR, stockPR, precioPR) VALUES('Lenteja Pardina',
    'Bolsa 1Kg. Procedencia Extremadura. Gran calidad', 'LP2010', 
    'images/lenteja_pardina.jpg', 1900, 1.3);
    
INSERT INTO TRABAJADORES(usuario, contrase�a, nombreT,
    apellidosT, telefonoT, correoT, direcci�nT,
    DNI_T, tipoT) VALUES('DEFENSA', 'defensa',
    'Administrador', 'IISSI', 123456789, 'administrador@iissi.com',
    'Sevilla ETSII', '12345678X', 'J');
    
INSERT INTO PEDIDOS(OID_C, OID_T) VALUES(1, 1);

INSERT INTO L�NEASPEDIDOS(cantidadLP, ordenLP, OID_P, OID_PR)
    VALUES(5, 1, 1, 1);
INSERT INTO L�NEASPEDIDOS(cantidadLP, ordenLP, OID_P, OID_PR)
    VALUES(7, 2, 1, 3);
INSERT INTO L�NEASPEDIDOS(cantidadLP, ordenLP, OID_P, OID_PR)
    VALUES(2, 3, 1, 2);