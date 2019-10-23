<?php

use yii\db\Migration;

/**
 * Class m191022_101440_hall_seven
 */
class m191022_101440_hall_seven extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('hall_seven', [
            'id' => $this->primaryKey(),
            'row' => $this->integer()->notNull(),
            'seat' => $this->integer()->notNull(),
            'is_free' => $this->boolean()->notNull()->defaultValue(1),
            'seance' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('hall_seven');
    }
}
