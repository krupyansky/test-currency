<?php

declare(strict_types=1);

namespace app\managers;

use app\constants\DateFormat;
use app\forms\CreateCurrency;
use app\models\Currency;

/**
 * Class CurrencyManager
 * @package app\managers
 */
final class CurrencyManager
{
    private Currency $currency;

    public function setCurrency(Currency $currency): void
    {
        $this->currency = $currency;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function createRecord(CreateCurrency $form): bool
    {
        $this->currency->currency = $form->currency;
        $this->currency->buy = $form->buy;
        $this->currency->sell = $form->sell;
        $this->currency->begins_at = $form->begins_at->format(DateFormat::DATE_FORMAT_BACK);
        $this->currency->office_id = $form->office_id;

        return $this->currency->save(false);
    }
}
