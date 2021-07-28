<?php

namespace app\validators;

use app\constants\DateFormat;
use DateTimeImmutable;
use yii\validators\Validator;

/**
 * Class DateValidator
 * @package app\validators
 */
final class DateValidator extends Validator
{
    /**
     * @param \yii\base\Model $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute): void
    {
        if (!$model->$attribute) {
            return;
        }

        $dateTime = DateTimeImmutable::createFromFormat(DateFormat::DATE_FORMAT_FRONT, $model->$attribute);

        if (!$dateTime) {
            $this->addError($model, $attribute, 'Некоректный формат даты');
            return;
        }

        $model->$attribute = $dateTime;
    }
}
