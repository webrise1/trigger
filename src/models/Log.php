<?php
namespace webrise1\trigger\models;
use yii\db\ActiveRecord;


class Log extends ActiveRecord {
    const STATUS_SUCCESS=1;
    const STATUS_ERROR=2;
    const STATUS_DANGER=3;
    public static function tableName()
    {
        return '{{%ext_triggers_log}}';
    }
    public function rules()
    {
        return [
            [['id','status'], 'integer'],
            [[ 'trigger_code'], 'string',],


        ];
    }
    public static function getStatuses(){
        return[
            self::STATUS_SUCCESS=>'Успех',
            self::STATUS_ERROR=>'Ошибка',
            self::STATUS_DANGER=>'Предупреждение',
        ];
    }
}