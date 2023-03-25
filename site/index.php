<?php
namespace index;
require_once  __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/settings.php';


use Core\Router;
use Datainterface\Database;
use ErrorLogger\ErrorLogger;


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
Router::navReader();
?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <?php
        /**
         * Routing is mapping from here Router::router();
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
Router::footerReader();
?>
