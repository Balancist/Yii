<?php

namespace app\modules\v1\modules\company\controllers;

use app\modules\v1\modules\company\models\Company;
use app\modules\v1\modules\company\models\CompanySearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
/**
 * @SWG\Info(
 *   version="1.0",
 *   title="Companies API"
 * )
 * @SWG\Tag(
 *   name="company",
 *   description="کمپانی",
 *   @SWG\ExternalDocumentation(
 *     description="Find out more about our store",
 *     url="http://swagger.io"
 *   )
 * )
 */
class CompanyController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['create', 'update', 'delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['create', 'update', 'delete'],
                            'roles' => ['admin']
                        ]
                    ]
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actions()
    {
        return [
            'doc' => [
                'class' => 'light\swagger\SwaggerAction',
                'restUrl' => \yii\helpers\Url::to(['/company'], true)
            ]
        ];
    }

    /**
     * @SWG\Get(
     *     path="/company",
     *     tags={"company"},
     *     summary="Index",
     *     description="index *query* *formData*  get",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response = 200,
     *         description = "success"
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "error",
     *         @SWG\Schema(ref="yii\web\Response::$httpStatuses->401")
     *     )
     * )
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @SWG\Get(
     *     path="/company/{id}",
     *     tags={"company"},
     *     summary="View",
     *     description="view *query* *formData*  get",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "path",
     *        name = "id",
     *        description = "شناسه",
     *        required = true,
     *        type = "integer"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "success"
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "error",
     *         @SWG\Schema(ref="yii\web\Response::$httpStatuses->401")
     *     )
     * )
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @SWG\Post(
     *     path="/company",
     *     tags={"company"},
     *     summary="Create",
     *     description="create post",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         in = "body",
     *         name = "company",
     *         @SWG\Schema(
     *             @SWG\Property(
     *                 name="name",
     *                 required="true",
     *                 type="string"
     *             ),
     *             @SWG\Property(
     *                 name="slug",
     *                 required="true",
     *                 type="string"
     *             ),
     *             @SWG\Property(
     *                 name="logo",
     *                 required="true",
     *                 type="string"
     *             )   
     *         )
     *     )
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "Error",
     *         @SWG\Schema(ref="yii\web\Response::$httpStatuses->401")
     *     )
     * )
     *
     */
    public function actionCreate()
    {
        $model = new Company();
        $all = Company::find()->all();
        $all_companies = [];
        foreach ($all as $company) {
            $all_companies[$company->id] = $company->name;
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'all' => $all_companies,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $all = Company::find()->all();
        $all_companies = [];
        foreach ($all as $company) {
            $all_companies[$company->id] = $company->name;
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'all' => $all_companies,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Company::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
