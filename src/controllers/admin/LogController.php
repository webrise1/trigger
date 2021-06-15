<?php
namespace webrise1\trigger\controllers\admin;

use webrise1\trigger\assets\AssetsBundle;
use webrise1\trigger\models\Log;
use webrise1\trigger\models\search\LogSearch;


class LogController extends \yii\web\Controller{
    public function actionIndex($trigger_id){
        AssetsBundle::register($this->view);
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search($trigger_id);
        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }


}