<?php 
use Illuminate\Database\Capsule\Manager as Capsule;
use  Illuminate\Database\Eloquent\Model;

require_once 'vendor/autoload.php';


class Task extends Model {
    protected $table = 'tasks';
}


$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'sqlite',
    'database'  => '/home/eloyhz/Code/PHP/todo-list-php/database/database.sqlite',
]);

/*
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'todo',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
*/

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

if (!empty($_POST)) {
    $task = new Task;
    $task->description = $_POST['description'];
    $task->save();    
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO list</title>
</head>
<body>
    <h1>Todo list</h1>
    <ul>
        <?php 
            $tasks = Task::all();
            foreach ($tasks as $t)  {
                echo '<li>' . $t->id . '</li>';
            }
        ?>
    </ul>
    <form method="POST">
        <input type="text" name="description" placeholder="Description">
        <input type="submit" value="Add">
    </form>
</body>
</html>