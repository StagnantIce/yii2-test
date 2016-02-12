<?php

use yii\db\Schema;
use yii\db\Migration;

class m160212_192454_init extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(),
            'username' => $this->string()->notNull(),
            'name'     => $this->string(),
            'last_name'  => $this->string(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'date_create' => $this->datetime()->notNull(),
            'date_update' => $this->datetime()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%books}}', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(),
            'preview'     => $this->string(),
            'date_create' => $this->datetime()->notNull(),
            'date_update' => $this->datetime()->notNull(),
            'date'        => $this->date()->notNull(),
            'author_id'   => $this->integer()->notNull(),
        ]);

        $this->createTable('{{%authors}}', [
            'id'           => $this->primaryKey(),
            'firstname'    => $this->string(),
            'lastname'     => $this->string()
        ]);

        $this->addForeignKey(
            'FK_book_author_id', '{{%books}}', 'author_id', '{{%authors}}', 'id', 'CASCADE', 'CASCADE'
        );

    }

    public function down()
    {
        echo "m160212_192454_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
