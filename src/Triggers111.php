<?php
namespace webrise1\trigger;
use webrise1\trigger\models\Log;
use webrise1\trigger\models\Trigger;

class Triggers111{
public $params;
public $currentTrigger;
public $triggerModel;

    public function __construct($triggerName,$params=null)
    {
        if($params)
            $this->params=$params;
        $this->currentTrigger=$this->getTrigger($triggerName);

    }

    final function getTrigger($triggerName){
       $trigger=$this->triggers()[$triggerName];
       if($trigger){
           $triggerModel=Trigger::findOne(['name'=>$triggerName]);
           if($triggerModel){
               $this->triggerModel=$triggerModel;
               return $trigger;
           }

       }
       $this->addSystemLog(Log::STATUS_ERROR,'Попытка вызова несуществующего триггера: '.$triggerName);
       return null;
    }


}