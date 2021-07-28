<?php

declare(strict_types=1);

namespace app\repositories;

use app\constants\DateFormat;
use app\forms\CreateCurrency;
use app\forms\GetCurrency;
use app\models\Currency;
use yii\db\Expression;

/**
 * Class CurrencyRepo
 * @package app\repositories
 */
final class CurrencyRepo
{
    public function getCurrenciesAsArray(GetCurrency $form): array
    {
        return Currency::find()
            ->select([
                'currency',
                new Expression('ROUND(buy / 100, 2) AS buy'),
                new Expression('ROUND(sell / 100, 2) AS sell'),
                'begins_at',
                'office_id'
            ])
            ->where(['office_id' => $form->office_id])
            ->orWhere(['office_id' => null])
            ->andWhere(['begins_at' => $form->at_date->format(DateFormat::DATE_FORMAT_BACK)])
            ->asArray()
            ->all();
    }

    public function existCurrency(CreateCurrency $form): bool
    {
        return Currency::find()
            ->where(['currency' => $form->currency])
            ->andWhere(['office_id' => $form->office_id])
            ->andWhere(['begins_at' => $form->begins_at->format(DateFormat::DATE_FORMAT_BACK)])
            ->exists();
    }
}
