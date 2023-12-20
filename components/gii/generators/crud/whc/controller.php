<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/** @var $this yii\web\View */
/** @var $generator app\components\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();


$modelClassLower = \yii\helpers\Inflector::pluralize(\yii\helpers\Inflector::camel2id($modelClass));

//Get Table comment
//$dbName = 'dbo';//Yii::$app->db->createCommand("SELECT DATABASE()")->queryScalar();
$tbName = $class::getOriginalTableName();
if (Yii::$app->db->getDriverName() == 'sqlsrv') {
    $sql = "select [value] AS TABLE_COMMENT
                from sys.extended_properties
                where [minor_id] = 0
                AND object_name([major_id]) ='$tbName'";
} else {
    $dbName = Yii::$app->db->createCommand("SELECT DATABASE()")->queryScalar();
    $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '$dbName' AND table_name = '$tbName' ";
}

$tables = Yii::$app->db
    ->createCommand($sql)
    ->queryOne();

$TABLE_COMMENT = $tables['TABLE_COMMENT'];

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use <?= ltrim($generator->modelClass, '\\') ?>;
use Yii;

<?php if (!empty($generator->searchModelClass)): ?>
    use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>

<?php endif; ?>


/**
* <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
*/


/**
* @SWG\Tag(
*   name="<?= $modelClassLower ?>",
*   description="<?= $TABLE_COMMENT ?>",
*   @SWG\ExternalDocumentation(
*     description="Find out more about our store",
*     url="http://swagger.io"
*   )
* )
*/
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{

public $modelClass = '<?= $class ?>';

/**
* @SWG\Get(
*     path="/<?= $modelClassLower ?>",
*     tags={"<?= $modelClassLower ?>"},
*     summary="Export",
*     description="export all rows",
*     produces = {"application/json"},
*     consumes = {"application/json"},
*     @SWG\Response(
*         response = 200,
*         description = " success"
*     )
* )
*
*/
public function actionIndex()
{
return parent::index();
}

/**
* @SWG\Get(
*    path="/<?= $modelClassLower ?>/{id}",
*    tags = {"<?= $modelClassLower ?>"},
*    summary = "search By ID",
*    description = "search by ID",
*    produces = {"application/json"},
*    consumes = {"application/json"},
*    @SWG\Parameter(
*        in = "path",
*        name = "id",
*        description = "<?= $modelClassLower ?> ID",
*        required = true,
*        type = "string"
*     ),
*    @SWG\Response(response = 200, description = "success")
*)
*/
public function actionView($id)
{
return parent::view($id);
}


/**
* @SWG\Post(
*     path="/<?= $modelClassLower ?>",
*     tags={"<?= $modelClassLower ?>"},
*     summary="Create",
*     description="create *query* *formData*  post",
*     produces={"application/json"},
<?php
foreach ($class::getTableSchema()->columns as $field => $attr) {
    if (!in_array($field, \Yii::$app->params['gii_no_change_field'])) {
        ?>
        *     @SWG\Parameter(
        *        in = "formData",
        *        name = "<?= $field ?>",
        *        description = "<?= $attr->comment ?> ",
        *        required = <?= ($attr->allowNull ? 'false' : 'true') ?>,
        *        type = "<?= \Yii::$app->params['gii_field_type'][$attr->type] ?>"
        *     ),
        <?
    }
}
?>
*
*     @SWG\Response(
*         response = 200,
*         description = " success"
*     ),
*     @SWG\Response(
*         response = 401,
*         description = "Error in Create",
*         @SWG\Schema(ref="#/definitions/Error")
*     )
* )
*
*/
public function actionCreate()
{
return parent::create();
}


/**
* @SWG\Put(
*     path="/<?= $modelClassLower ?>/{id}",
*     tags={"<?= $modelClassLower ?>"},
*     summary="Update Info <?= $modelClassLower ?>",
*     description="*path update",
*     produces={"application/json"},
*     @SWG\Parameter(
*        in = "path",
*        name = "id",
*        description = "ID",
*        required = true,
*        type = "integer"
*     ),
<?php
foreach ($class::getTableSchema()->columns as $field => $attr) {
    if (!in_array($field, \Yii::$app->params['gii_no_change_field'])) {
        ?>
        *     @SWG\Parameter(
        *        in = "formData",
        *        name = "<?= $field ?>",
        *        description = "<?= $attr->comment ?>",
        *        required = <?= ($attr->allowNull ? 'false' : 'true') ?>,
        *        type = "<?= \Yii::$app->params['gii_field_type'][$attr->type] ?>"
        *     ),
        <?
    }
}
?>
*
*     @SWG\Response(
*         response = 200,
*         description = " success"
*     ),
*     @SWG\Response(
*         response = 401,
*         description = "Error",
*         @SWG\Schema(ref="#/definitions/Error")
*     )
* )
* @param integer $id
*
* @return array
*/
public function actionUpdate($id)
{
return parent::update($id);
}


/**
* @SWG\Get(
*    path="/<?= $modelClassLower ?>/get-by-params",
*    tags = {"<?= $modelClassLower ?>"},
*    summary = "search",
*    description = "search by code",
*    produces = {"application/json"},
*    consumes = {"application/json"},
<?php
foreach ($class::getTableSchema()->columns as $field => $attr) {
    if ($field != 'id') {
        ?>
        *     @SWG\Parameter(
        *        in = "query",
        *        name = "<?= $field ?>",
        *        description = "<?= $attr->comment ?> ",
        *        required = false,
        *        type = "<?= \Yii::$app->params['gii_field_type'][$attr->type] ?>"
        *     ),
        <?
    }
}
?>
*    @SWG\Response(response = 200, description = "success")
*)
*/
public function actionGetByParams()
{

$searchModel = new <?= $modelClass ?>();

$dataProvider = $searchModel->getResultByParams(['<?= $modelClass ?>'=>Yii::$app->request->queryParams]);
return $dataProvider ;
}


/**
* @SWG\Delete(
*    path="/<?= $modelClassLower ?>/{id}",
*    tags = {"<?= $modelClassLower ?>"},
*    summary = "delete by id",
*    description = "delete by id",
*    produces = {"application/json"},
*    consumes = {"application/json"},
*    @SWG\Parameter(
*        in = "path",
*        name = "id",
*        format = "int32",
*        description = "id",
*        required = true,
*        type = "integer"
*     ),
*    @SWG\Response(response = 204, description = "success")
*)
*/
public function actionDelete($id)
{
return parent::delete($id);
}
}