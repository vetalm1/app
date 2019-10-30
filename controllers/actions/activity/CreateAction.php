<?php


namespace app\controllers\actions\activity;


use app\models\Activity;
use yii\base\Action;

class CreateAction extends Action
{
    public $name;
    public  function run()
    {
        $model = new Activity();

        if (\Yii::$app->request->isPost){  // проверка существует ли пост запрос забыть про $_POST в Yii :))
            $model->load(\Yii::$app->request->post()); // наполнение модели, атрибут который в правилах не объявлен, через функцию load не наполняется
            //print_r($model->getAttributes());
            //exit; //чтобы сработал print_r  ато он пропускается
            if (!$model->validate()) { //если все правила выполняются то тру, иначе фолс
                //print_r($model->getErrors()); // выводит массив ошибок
                //exit;
                \Yii::error($model->getErrors()); // запишет ошибки в лог, но  нужно включить дебагер, включил.
            }
        }

        return $this->controller->render('create', ['name'=>$this->name, 'model'=>$model]);
    }
}