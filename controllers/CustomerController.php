<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use app\models\Customer;
use app\models\CustomertSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
    /**
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomertSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $first = new Customer();
        $model = [new Customer];
        if ($first->load(Yii::$app->request->post())) {
            $model = Model::createMultiple(Customer::classname());
            Model::loadMultiple($model, Yii::$app->request->post());
            
            
            
            foreach ($model as $t) {
                $t->client_id = $first->client_id;
                $t->date_sale = $first->date_sale;
                if (empty($t->price_sale)){

                    $t->price_sale = \app\models\Product::find()->where(['category_id'=>$t->product_id])->where([">","count",0])->max('prise_sale');
                }else{

           
                $t->price_sale;

                }
                // exit;
                // $t->price_sale = \app\models\Product::find()->where(['category_id'=>$t->product_id])->where([">","count",0])->max('prise_sale');
                $t->total_sum = $t->price_sale * $t->count;
                $t->save();
            }

            foreach ($model as $key){
                $product = Product::find()->where(['>','count',0])->where(['category_id'=>$key->product_id])->orderBy(['date'=>SORT_ASC])->all();
                $count = $key->count;
                foreach($product as $one){
                    $c = $one->count;
                    $a = $count - $c;
                    if($a==0){
                        $one->count =0;
                        $one->save();
                        break;
                    }elseif($a>0){
                        $one->count=0;
                        $one->save();
                        $count -=$c;
                    }else{
                        $one->count = $c-$count;
                        $one->save();
                        break;
                    }
                }
   //echo "<pre>". print_r($model,true)."</pre>";

//                $product = \app\models\Product::find()->where(['id'=>$key->product_id])->one();
//                $sum = $product->count -  $key->count;
//                $old->count = $sum;
                //echo "<pre>".print_r($pr,true)."</pre>";
                /*
                echo "<pre>".print_r(  $old->update(false),true)."</pre>";
                echo "<pre>".print_r($old->getErrors(),true)."</pre>";*/

            }


            return $this->redirect(['index']);

        }
        return $this->render('create',
            [
                'first' => $first,
                'model' => (empty($model)) ? [new Customer] : $model
            ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCreate1($template_id = null)
    {
        if (Template::find()->where(['id' => $template_id])->exists()) {
            $first = new \common\models\TemplateWork();
            $model = [new \common\models\TemplateWork];
            if ($first->load(Yii::$app->request->post())) {
                $model = Model::createMultiple(\common\models\TemplateWork::classname());
                Model::loadMultiple($model, Yii::$app->request->post());
                foreach ($model as $t) {
                    $t->template_id = $template_id;
                    $t->status = 1;
                    $t->save(false);

                }
                return $this->redirect(['view', 'id' => $template_id]);

            }
            return $this->render('worker',
                [
                    'first' => $first,
                    'model' => (empty($model)) ? [new \common\models\TemplateWork] : $model,
                    'template_id' => $template_id
                ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }


    public function actionSt(){

        $caterory = Category::find();
        $product = Product::find()->where(['category_id'=>$caterory->id])->one();


        return $this->render('st',[
            'product' =>$product,
        ]);
    }


}
