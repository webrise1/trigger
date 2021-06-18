<?php
namespace webrise1\trigger;

use yii\base\Module as BaseModule;
class Module extends BaseModule
{
    const EXT_NAME='ext-trigger';
    public $controllerNamespace = 'webrise1\trigger\controllers';
    public $triggerModel;
    public static function getMenuItems($label){
        return  [
            'label' => $label, 'icon' => 'microchip','url' => ['/'.self::EXT_NAME.'/admin/default']
        ];
    }

}