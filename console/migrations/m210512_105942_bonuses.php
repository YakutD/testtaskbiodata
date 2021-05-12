<?php

use yii\db\Migration;

/**
 * Class m210512_105942_bonuses
 */
class m210512_105942_bonuses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bonuses', [
            'id' =>      $this->primaryKey()->notNull(),
            'name' =>   $this->string(50)->notNull(),
            'amount'   =>  $this->integer()->defaultValue(null)
        ]);

        $sql = <<<SQL
INSERT INTO bonuses
(name, amount)
VALUES
('Бесплатное обследование', 5),
('Кружка с логотипом "БиоДата"', 3),
('Скидка на поездку в санаторий', NULL)
SQL;

        Yii::$app->db->createCommand($sql)->execute();   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('bonuses');

        echo "m210512_105942_bonuses cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210512_105942_bonuses cannot be reverted.\n";

        return false;
    }
    */
}