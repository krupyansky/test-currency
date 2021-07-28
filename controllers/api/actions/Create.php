<?php

declare(strict_types=1);

namespace app\controllers\api\actions;

use app\forms\CreateCurrency;
use app\managers\CurrencyManager;
use app\models\Currency;
use app\repositories\CurrencyRepo;
use JetBrains\PhpStorm\ArrayShape;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\Request;
use yii\web\ServerErrorHttpException;

/**
 * Class Create
 * Сохранение курса валюты
 * Сервис позволяет сохранить курс покупки
 * и продажи для заданной валюты.
 * Можно сохранить несколько курсов для одной валюты,
 * которые будут различаться временем начала действия.
 *
 * @package app\controllers\actions
 */
final class Create extends Action
{
    private CurrencyRepo $repo;
    private CurrencyManager $manager;

    public function __construct(
        $id,
        $controller,
        CurrencyRepo $repo,
        CurrencyManager $manager,
        $config = []
    )
    {
        $this->repo = $repo;
        $this->manager = $manager;

        parent::__construct($id, $controller, $config);
    }

    /**
     * @param \yii\web\Request $request
     * @return array
     * @throws \yii\web\BadRequestHttpException|\yii\web\ServerErrorHttpException
     */
    #[ArrayShape(['id' => "int"])]
    public function run(Request $request): array
    {
        $form = new CreateCurrency();
        $form->load($request->post(), '');

        if (!$form->validate()) {
            throw new BadRequestHttpException();
        }

        $exist = $this->repo->existCurrency($form);
        if ($exist) {
            throw new ServerErrorHttpException;
        }

        $this->manager->setCurrency(new Currency());
        $ok = $this->manager->createRecord($form);

        if (!$ok) {
            throw new ServerErrorHttpException();
        }

        return ['id' => $this->manager->getCurrency()->id];
    }
}
