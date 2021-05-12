<?php

use yii\db\Migration;

/**
 * Class m210512_143151_user
 */
class m210512_143151_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $time = time();
        $password_hash = Yii::$app->getSecurity()->generatePasswordHash('qqqqqq');
        $auth_key = Yii::$app->security->generateRandomString();
        $table = 'user';

        $sql = <<<SQL
INSERT INTO {$table}
(`username`, `email`,`password_hash`, `auth_key`, `created_at`, `updated_at`)
VALUES
('admin', 'admin@biodata.com',  '$password_hash', '$auth_key', {$time}, {$time})
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');

        echo "m210512_143151_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210512_143151_user cannot be reverted.\n";

        return false;
    }
    */
}
