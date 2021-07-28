<?php

namespace app\forms;

use app\validators\DateValidator;
use yii\base\Model;

/**
 * Class GetCurrency
 * @package app\forms
 */
final class GetCurrency extends Model
{
    public $office_id;
    public $at_date;

    public function rules(): array
    {
        return [
            [['office_id', 'at_date'], 'required'],
            [['office_id', 'at_date'], 'string'],
            [['at_date'], DateValidator::class],
        ];
    }
}
