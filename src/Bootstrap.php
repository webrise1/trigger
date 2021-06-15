<?php
namespace webrise1\trigger;

use Yii;
use yii\base\BootstrapInterface;
class Bootstrap implements BootstrapInterface{

    public function bootstrap($app)
    {

        //Правила маршрутизации
        $app->getUrlManager()->addRules([
            'admin/trigger/<controller>/<action>' => 'trigger/admin/<controller>/<action>',
           'admin/trigger/<controller>' => 'trigger/admin/<controller>',


//           'pdf/certificate' => 'pdfgenerator/api/api/get-certificate',

        ], false);

    }
}