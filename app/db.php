<?php 
function getConection () {
    return new PDO ('mysql:host=localhost;dbname=db_tareas;charset=utf8', 'root', '');
}

/**
 * obtiene y devuelve de la base de datos todas las tareas
 */
function getTasks() {
    //1. abrimos una conexion con la base de datos
    $db = getConection();

    //2. enviamos la consulta y obtenemos el resultado
    $query = $db ->prepare('SELECT * FROM tareas');
    $query->execute();

    // obtengo los datos que arroja la query
    $tasks = $query->fetchAll(PDO::FETCH_OBJ);

   return $tasks;
}

/**
 * inserto la tarea en la DB
 */
function insertTask($title, $description, $priority) {
    $db = getConection(); 

    $query = $db->prepare('INSERT INTO tareas (titulo, descripcion, prioridad) VALUES (?,?,?)');
    $query->execute([$title, $description, $priority]);

    return $db->lastInsertId();
}