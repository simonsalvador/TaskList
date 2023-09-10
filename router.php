<?php
require_once 'app/tasks.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// el router va a leer la action desde el paramtro "action"

$action = 'listar'; // accion por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion Ej: noticia/1 --> ['noticia', 1]
$params = explode('/', $action);

switch ($params[0]) { // en la primer posicion tengo la accion real
    case 'listar':
        showTasks();
        break;
    case 'agregar':
        addTask();
        break;
    case 'eliminar':
        removeTask($params[1]);
        break;
    case 'finalizar':
        finishTask($params[1]);
        break;
    default:
        echo "404 Page Not Found";
        break;
}
