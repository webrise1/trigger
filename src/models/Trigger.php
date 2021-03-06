<?php
namespace webrise1\trigger\models;
use yii\base\ExitException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use Yii;
use yii\base\Exception;

class Trigger extends ActiveRecord {
    const STATUS_ENABLE=1;
    const STATUS_DISABLE=2;
    const TABLE_NAME='ext_trigger_trigger';
    public $params;
    public $trigger_code;
    public $result;
    public static function tableName()
    {
        return self::TABLE_NAME;
    }
    public function __construct(array $config = [])
    {
        $this->trigger_code=Yii::$app->security->generateRandomString(12);
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['id','status'], 'integer'],
            [[ 'name','title','function_name'], 'string',],
            [[ 'name','title','function_name'],'required'],
            [[ 'name'],'unique'],

        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'TriggerName',
            'title'=>'Название',
            'status'=>'Статус',
            'function_name'=>'Функция'

        ];
    }
    public static function getStatuses(){
        return[
            self::STATUS_ENABLE=>'Включен',
            self::STATUS_DISABLE=>'Выключен',
        ];
    }

    public function executeTrigger($only_enable=true){
        $infoMessage=
            'trigger.id:'.$this->id
            .', trigger.function_name: '.$this->function_name
            .', controller: '.(new \ReflectionObject(Yii::$app->controller))->getName();
        $infoMessage='('.$infoMessage.')';
        if($only_enable){
            if($this->status==self::STATUS_DISABLE){
                self::addSystemLog(Log::STATUS_DANGER,'Попытка вызова отключенного триггера'.$infoMessage);
                return false;
            }
        }
        $function=$this->getTriggerFunctionByName($this->function_name);

        if(!empty($function['value'])){
            try{
                $this->result = $function['value']();
            }catch (Exception $e){

            }

            return true;
        }else
            self::addSystemLog(Log::STATUS_ERROR,'Вызов триггера с несуществующей функцией '.$infoMessage);
        return false;
    }
    public static function getByTriggerName($name){
        $trigger=self::find()->where(['name'=>$name]);
        $trigger->one();
        return $trigger;
    }
    public function getTriggerFunctionByName($triggerFunctionName){

        $functions=$this->TriggerFunctions();

        if(!empty($functions[$triggerFunctionName])){
            return $functions[$triggerFunctionName];
        }
        return null;
    }
    public function getTitleTriggerFunctionByName($triggerFunctionName){
        $func=$this->getTriggerFunctionByName($triggerFunctionName);
        if($func)
            $title=($func['title'])?$func['title']:$triggerFunctionName;
        else
            $title='<span style="color:red">Не найденна функция: '.$triggerFunctionName.'</span>';
        return $title;
    }


    public function getArrayMapFunctions(){
        $arraymap=[];
        $functions=$this->TriggerFunctions();
        foreach($functions as $name=>$function){
            $arraymap[$name]=(($function['title'])?$function['title']:$name);
        }
        return $arraymap;
    }
    public function TriggerFunctions(){
        return null;
    }

    public function addLog($status,$message){
        $log=new Log();
        $log->trigger_id=$this->id;
        $log->trigger_code=$this->trigger_code;
        $log->message=$message;
        $log->status=$status;
        $log->save();
    }
    public static function addSystemLog($status,$message){
        $log=new Log();
        $log->trigger_id=0;
        $log->message=$message;
        $log->status=$status;
        $log->save();
    }

}