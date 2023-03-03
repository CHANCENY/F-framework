<?php @session_start(); 

use GlobalsFunctions\Globals;
use Modules\CountriesModular;
use ApiHandler\ApiHandlerClass;
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: GET');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

$action = Globals::get('action');
if($action === "states"){
    $countryCode = Globals::get('code');
    echo ApiHandlerClass::stringfiyData(CountriesModular::getStateByCountry($countryCode));
}elseif ($action === "cities"){
    $statescode = Globals::get('code');
    echo ApiHandlerClass::stringfiyData(CountriesModular::getCitiesByStates($statescode));
}
?>