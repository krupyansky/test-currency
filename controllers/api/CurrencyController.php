<?php

namespace app\controllers\api;

use app\controllers\api\actions\Create;
use app\controllers\api\actions\Get;
use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Class CurrencyController
 * @package app\controllers
 */
final class CurrencyController extends Controller
{
    /**
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action): bool
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: DELETE, POST, GET, OPTIONS');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin, Accept, X-Requested-With, X-Auth-Token, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, Authorization, X-CSRF-Token');

        return parent::beforeAction($action);
    }

    #[ArrayShape(['create' => "string", 'get' => "string"])]
    public function actions(): array
    {
        return [
            'create' => Create::class,
            'get'    => Get::class,
        ];
    }
}
