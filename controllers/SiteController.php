<?php

namespace app\controllers;

use app\models\Product;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Members;
use app\models\Courses;
use app\models\Districts;
use app\models\Organization;
use linslin\yii2\curl;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\helpers\Json;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [

            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],

        ];
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }

    public function actionForm()
    {
        return $this->render('form');
    }

    public function actionMaterial(){
        $model = new \app\models\Profit();
        return $this->render('material',compact('model'));
    }

    public function actionTest($select=0)
    {
        $model = new \app\models\Profit();
        if(Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $model->date1 = $data['date1'];
            $model->date2 = $data['date2'];
            $model->select = $data['select'];
            $model->form($select);
        }
    }
    public function actionAllProduct(){
        $model = new \app\models\Profit();
        return $this->render('all-product',compact('model'));
    }








    protected function findModel($id)
    {
        if (($model = Members::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function beforeAction($action)
    {
        if ($action->id == 'error')
            $this->layout = 'site_layout';

        return parent::beforeAction($action);
    }
}
