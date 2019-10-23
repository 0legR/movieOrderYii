<?php

use yii\db\Migration;

/**
 * Class m191022_113901_seances
 */
class m191022_113901_seances extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('seances', [
            'id' => $this->primaryKey(),
            'movie' => $this->string(512)->notNull(),
            'date_time' => $this->timestamp()->notNull(),
            'price' => $this->integer()->notNull(),
            'hall' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->insert('seances', [
            'movie' => 'Стартрек: За межами Всесвіту',
            'date_time' => '2019-07-25 10:10:00',
            'price' => 55,
            'hall' => 7
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('seances');
    }
}
