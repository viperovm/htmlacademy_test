<?php

require_once 'Task.php'

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php

    $task1 = new Task(133, 114);
    echo $task1->getImplementerId() . '<br>';
    echo $task1->getCustomerId() . '<br>';
    echo $task1->getCurrentStatus() . '<br>';
    print_r($task1->getPossibleCurrentActions());
    echo '<br>';
    $task1->setCurrentAction('message');
    echo $task1->getCurrentStatus();




?>

</body>
</html>
