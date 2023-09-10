<?php
require_once './app/db.php';


function showTasks()
{
    require 'templates/header.php';
    //obtengo las tareas
    $tasks = getTasks();

    require 'templates/form_alta.php';
?>

    <ul class="list-group ">
        <?php foreach ($tasks as $task) { ?>
            <li class="list-group-item item-task <?php if($task->finalizada) echo 'finalizada' ?>">
                <div>
                <b> <?php echo $task->titulo; ?> </b>| (Prioridad <?php echo $task->prioridad; ?>)
                </div>
                <div class="actions">
                <?php if(!$task->finalizada) { ?> <a href="finalizar/<?php echo $task->id ?>" type="button" class='btn btn-success ml-auto'>Finalizar</a> <?php } ?>
                    <a href="eliminar/<?php echo $task->id ?>" type="button" class='btn btn-danger ml-auto'>Borrar</a>
                </div>
            </li>

        <?php } ?>
    </ul>

<?php
    require 'templates/footer.php';
}

function addTask()
{

    //TODO: validacion de datos
    if (
        !empty($_POST['title'])
        && !empty($_POST['description'])
        && !empty($_POST['priority'])
    ) {
        //obtengo  los datos del usuario
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
    } else {
        echo "<h2> Error! completa los campos! </h2>";
    }
    //inserto en la DB
    $id = insertTask($title, $description, $priority);

    if ($id) {
        //redirigo al usuario a la pagina principal
        header('Location:' . BASE_URL);
    } else {
        echo "Error al insertar la tarea";
    }
}

function removeTask($id){
    deleteTask($id);
    header('Location:' . BASE_URL);
}

function finishTask($id){
    updateTask($id);
    header('Location:' . BASE_URL);
}