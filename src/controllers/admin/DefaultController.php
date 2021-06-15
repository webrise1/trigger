<?php
namespace webrise1\trigger\controllers\admin;


use webrise1\trigger\models\search\TriggerSearch;
use webrise1\trigger\models\Trigger;
use Yii;
use yii\web\NotFoundHttpException;
class DefaultController extends \yii\web\Controller{

    public function actionIndex(){
        $searchModel = new TriggerSearch();
        $dataProvider = $searchModel->search($this->module->triggerModel);
        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
            );
    }
    public function actionCreate(){
        $model=new $this->module->triggerModel();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id){
        $model=$this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    protected function findModel($id)
    {
         $class= $this->module->triggerModel;
        if (($model = $class::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}