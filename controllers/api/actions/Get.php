<?php

declare(strict_types=1);

namespace app\controllers\api\actions;

use app\forms\GetCurrency;
use app\repositories\CurrencyRepo;
use JetBrains\PhpStorm\ArrayShape;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\Request;

/**
 * Class Get
 * Сервис позволяет получить список курсов валют
 * для заданного офиса на определённую дату и время.
 * Т.е. в списке должны быть последние
 * подходящие подуказанную дату и время курсы валют.
 *
 * @package app\controllers\actions
 */
final class Get extends Action
{
    private CurrencyRepo $repo;

    public function __construct(
        $id,
        $controller,
        CurrencyRepo $repo,
        $config = []
    )
    {
        $this->repo = $repo;

        parent::__construct($id, $controller, $config);
    }

    /**
     * @throws \yii\web\BadRequestHttpException
     */
    #[ArrayShape(['data' => "array"])]
    public function run(Request $request): array
    {
        $form = new GetCurrency();
        $form->load($request->get(), '');

        if (!$form->validate()) {
            throw new BadRequestHttpException();
        }

        $collection = $this->repo->getCurrenciesAsArray($form);

        return ['data' => $collection];
    }
}
