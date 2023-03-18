<?php
namespace index;
require_once  __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/settings.php';


use Core\Router;
use Datainterface\mysql\DeletionLayer;
use Datainterface\mysql\InsertionLayer;
use Datainterface\mysql\QueryLayer;
use Datainterface\mysql\SelectionLayer;
use Datainterface\mysql\TablesLayer;
use Datainterface\mysql\UpdatingLayer;
use Datainterface\Tables;
use Datainterface\Database;
use ErrorLogger\ErrorLogger;
use ApiHandler\ApiHandlerClass;
use MiddlewareSecurity\Security;
use ConfigurationSetting\ConfigureSetting;
use Sessions\Store;

global $THIS_SITE_ACCESS_LOCK;

if($THIS_SITE_ACCESS_LOCK === false){
    Router::errorPages(401);
}

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
