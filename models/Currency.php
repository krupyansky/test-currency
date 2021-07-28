<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $currency Сокращенное название валюты
 * @property int $buy Цена покупки
 * @property int $sell Цена продажи
 * @property string $begins_at Дата начала действия курса
 * @property string|null $office_id Код или id офиса
 */
class Currency extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'currency';
    }
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['currency', 'buy', 'sell', 'begins_at'], 'required'],
            [['buy', 'sell'], 'integer'],
            [['begins_at'], 'safe'],
            [['currency'], 'string', 'max' => 10],
            [['office_id'], 'string', 'max' => 50],
        ];
    }
}
