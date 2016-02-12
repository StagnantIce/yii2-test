<?php

use yii\db\Schema;
use yii\db\Migration;

use app\models\User;
use app\models\Authors;

class m160212_193449_test_data extends Migration
{
    public function up()
    {
        $user = new User();
        $user->username = 'admin';
        $user->email = 'tria-aa@mail.ru';
        $user->name  = 'admin';
        $user->last_name = 'admin';
        $user->password = 'admin';
        $user->generateAuthKey();
        $user->save();

        $author = new Authors();
        $author->lastname = 'Alexeew';
        $author->firstname = 'Artemiy';
        $author->save();

        $author = new Authors();
        $author->lastname = 'Ivanov';
        $author->firstname = 'Ivan';
        $author->save();
    }

    public function down()
    {
        echo "m160212_193449_test_data cannot be reverted.\n";

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
