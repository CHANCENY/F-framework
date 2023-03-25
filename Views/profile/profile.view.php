<?php @session_start();
$user = \GlobalsFunctions\Globals::user()[0];
\Core\Router::attachView('heros',['name'=>$user['firstname'].' '.$user['lastname']]);

?>