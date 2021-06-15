<?php
namespace webrise1\trigger\models;
use yii\db\ActiveRecord;


class Log extends ActiveRecord {
    const STATUS_SUCCESS=1;
    const STATUS_ERROR=2;
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
            self::STATUS_SUCCESS=>'Удачно',
            self::STATUS_ERROR=>'Ошибка',
        ];
    }
}