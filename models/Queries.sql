/*Join de ventas*/
USE havtechnology;

SELECT V.id, C.nombre, CONCAT('$', V.total) AS 'total', DATE_FORMAT(V.fecha, "%d/%m/%Y") AS 'fecha' FROM Venta AS V, Cliente AS C
WHERE V.idCliente = C.id ORDER BY V.id;

SELECT P.id, P.nombre, P.descripcion, P.color, P.lote, P.stock, Prov.nombre AS 'nombreProveedor' FROM Producto P, ProductoUnico PU, Proveedor Prov
WHERE P.id = PU.id AND PU.idProveedor = Prov.id;

INSERT INTO Proveedor VALUES ('nombre', 'telefono', 'correo');
INSERT INTO Producto VALUES ('id', 'nombre', 'descripcion', 'color', 'lote', 'stock', 'idProveedor');
