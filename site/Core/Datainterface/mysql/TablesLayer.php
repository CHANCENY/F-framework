<?php

namespace Datainterface\mysql;

use Datainterface\Database;
use Datainterface\Query;

class TablesLayer
{

   private array $schemas;

   private array $tables;

   public function getTables() : TablesLayer {
       $query = "SHOW TABLES";
       $dbname = Database::getDbname();
       $tables = Query::query($query);
       foreach ($tables as $table=>$value){
           $this->tables[] = $value["Tables_in_{$dbname}"];
       }
       return $this;
   }

   public function tables() : array{
       return $this->tables;
   }

   public function schema() : array{
       return $this->schemas;
   }

   public function getSchemas() : TablesLayer{
       $tables = $this->getTables()->tables();
       if(!empty($tables)){
           foreach ($tables as $key=>$value){
               $query = "DESCRIBE {$value}";
               $this->schemas[$value] = Query::query($query);
           }
       }
       return $this;
   }


}