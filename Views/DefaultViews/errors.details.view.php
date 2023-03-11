<?php @session_start();
if(\GlobalsFunctions\Globals::method() === 'GET'){
   if(\GlobalsFunctions\Globals::params()){
       $params = \GlobalsFunctions\Globals::params();
       if(isset($params['eid'])){
           $eid = htmlspecialchars(strip_tags($params['eid']));
           $details = \ErrorLogger\ErrorLogger::getDetails($eid);

           if(!empty($details)){
               foreach ($details as $detail=>$value){
                   
               }
           }
       }
   }
}
?>