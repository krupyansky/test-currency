<?php

namespace app\forms;

use app\validators\DateValidator;
use yii\base\Model;

/**
 * Class CreateCurrency
 * @package app\forms
 */
final class CreateCurrency extends Model
{
    public $currency;
    public $buy;
    public $sell;
    public $begins_at;
    public $office_id;

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['currency', 'buy', 'sell', 'begins_at'], 'required'],
            [['currency', 'begins_at', 'office_id'], 'string'],
            [['buy', 'sell'], 'number'],
            [['buy', 'sell'], 'convertMoney'],
            [['begins_at'], DateValidator::class],
        ];
    }

    public function convertMoney(string $attribute): void
    {
        $this->$attribute = (int) $this->$attribute * 100;
    }
}
