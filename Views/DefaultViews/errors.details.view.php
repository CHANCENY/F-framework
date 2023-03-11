<?php
@session_start();

$user = \GlobalsFunctions\Globals::user();
if(isset($user) && $user[0]['role'] === 'Admin'){
    $action = \GlobalsFunctions\Globals::get('action');
    $eid = \GlobalsFunctions\Globals::get('eid');
    if($action === 'details'){
        $result = \ErrorLogger\ErrorLogger::getDetails($eid);
        $list = explode('.',$result[0]['location']);
        if(end($list) === 'php'){
            $location = $result[0]['location'];
        }else{
            $location = unserialize($result[0]['location']);
        }
        $result[0]['location'] = $location;
        echo \Core\Router::clearUrl(\ApiHandler\ApiHandlerClass::stringfiyData($result));
       exit;
    }
    if($action === "delete"){
        $result = \ErrorLogger\ErrorLogger::deleteByErrorId($eid);
        $message = $result === true ? "Deleted this error log" : "Failed to delete this error log";
        echo \ApiHandler\ApiHandlerClass::stringfiyData(['msg'=>$message,'status'=>200]);
        exit;
    }

}


