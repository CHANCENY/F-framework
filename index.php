<?php
namespace index;
require_once  __DIR__.'/vendor/autoload.php';

use Alerts\Alerts;
use Core\Router;
use Datainterface\Tables;
use Datainterface\Database;
use Dompdf\Options;
use ErrorLogger\ErrorLogger;
use GlobalsFunctions\Globals;
use ApiHandler\ApiHandlerClass;
use Json\Json;
use Json\JsonOperation;
use MiddlewareSecurity\Security;
use ConfigurationSetting\ConfigureSetting;
use PDF\PDF;


// enable these two line to show error on web page
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);



@session_start();

try{
    Database::installer();
}catch (\Exception $e){
    ErrorLogger::log($e);
    Router::errorPages(500);
    exit;
}
ApiHandlerClass::isApiCall();

try{
    $security = new Security();
    $user= $security->checkCurrentUser();

    if($user === "U-Admin"){
        require_once 'Views/DefaultViews/nav.php';
    }else{
        /*
         * Your nav will load from here if exist in Views directory
         */
        if(file_exists('Views/nav.view.php')){
            require_once 'Views/nav.view.php';
        }else{
            //default nav will load here with menus that are not admin based
            require_once 'Views/DefaultViews/nav.php';
        }

        global $connection;

        $connection = Database::database();

        if(!empty(ConfigureSetting::getDatabaseConfig())){
            if(!Tables::tablesExists()){
                Tables::installTableRequired();
            }
        }
    }
}catch (\Exception $e){
    ErrorLogger::log($e);
    Router::errorPages(500);
    exit;
}
?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <?php
        /**
         * Routing is happing from here Router::router();
         */
        try{
            
            Router::router(true);
            if(isset($_SESSION['message']['route']) && !empty($_SESSION['message']['route'])){
                Router::errorPages(404);
                $_SESSION['message']['route'] = "";
            }
        }catch (\Exception $e){
            ErrorLogger::log($e);
            Router::errorPages(500);
            exit;
        }

        ?>
    </div>
</main>
<?php

if($user === "U-ADMIN"){
    require_once 'Views/DefaultViews/footer.php';
}else{
    /*
    * Your nav will load from here if exist in Views directory
    */
    if(file_exists('Views/footer.view.php')){
        require_once 'Views/footer.view.php';
    }else{
        //default nav will load here with menus that are not admin based
        require_once 'Views/DefaultViews/footer.php';
    }
}
?>
