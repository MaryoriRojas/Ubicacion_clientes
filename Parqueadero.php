<?php
class Parqueadero {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarCliente($cliente, $ubicacion) {
        $query = "INSERT INTO registros (cliente_id, ubicacion_id) VALUES (:cliente_id, :ubicacion_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":cliente_id", $cliente->id);
        $stmt->bindParam(":ubicacion_id", $ubicacion->id);

        if ($stmt->execute()) {
            $ubicacion->actualizarDisponibilidad($ubicacion->id, false);
            return true;
        }
        return false;
    }
}
