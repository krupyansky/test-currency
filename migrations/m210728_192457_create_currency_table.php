<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m210728_192457_create_currency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'currency' => $this->string(10)->notNull()->comment('Сокращенное название валюты'),
            'buy' => $this->integer()->notNull()->comment('Цена покупки'),
            'sell' => $this->integer()->notNull()->comment('Цена продажи'),
            'begins_at' => $this->dateTime()->notNull()->comment('Дата начала действия курса'),
            'office_id' => $this->string(50)->comment('Код или id офиса')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currency}}');
    }
}
