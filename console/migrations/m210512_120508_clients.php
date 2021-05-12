<?php

use yii\db\Migration;

/**
 * Class m210512_120508_clients
 */
class m210512_120508_clients extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('clients', [
            'id' =>      $this->primaryKey()->notNull(),
            'fb_id' =>   $this->string(100)->notNull(),
            'created_at' =>  $this->date()->notNull(),
            'bonus'   =>  $this->integer()->defaultValue(null)
        ]);

        // Добавляем foreign key
        $this->addForeignKey(
            'bonusId',  // это "условное имя" ключа
            'clients', // это название текущей таблицы
            'bonus', // это имя поля в текущей таблице, которое будет ключом
            'bonuses', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('clients');
         
        //Добавляем удаление внешнего ключа
        $this->dropForeignKey(
              'bonusId'
        );

        echo "m210512_120508_clients cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210512_120508_clients cannot be reverted.\n";

        return false;
    }
    */
}
