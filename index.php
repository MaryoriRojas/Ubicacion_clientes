<?php
include_once 'Database.php';
include_once 'Cliente.php';
include_once 'Ubicacion.php';
include_once 'Parqueadero.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);
$ubicacion = new Ubicacion($db);
$parqueadero = new Parqueadero($db);

echo "Por favor, ingresa la siguiente informacion del cliente:\n";
echo "Nombre: ";
$cliente->nombre = trim(fgets(STDIN));

echo "Placa: ";
$cliente->placa = trim(fgets(STDIN));

echo "Telefono: ";
$cliente->telefono = trim(fgets(STDIN));

if ($cliente->crear()) {
    $cliente_id = $cliente->obtenerID();
    $ubicacion_libre = $ubicacion->obtenerLibre();

    if ($ubicacion_libre) {
        echo "Ubicacion encontrada con ID: " . $ubicacion_libre['id'] . "\n";
        $ubicacion->id = $ubicacion_libre['id'];
        if ($parqueadero->registrarCliente($cliente, $ubicacion)) {
            echo "Cliente registrado en la ubicacion " . $ubicacion->id . "\n";
        } else {
            echo "No se pudo registrar el cliente en la ubicacion.\n";
        }
    } else {
        echo "No hay ubicaciones libres disponibles.\n";
    }
} else {
    echo "No se pudo registrar el cliente.\n";
}