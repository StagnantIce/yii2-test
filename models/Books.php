<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $preview
 * @property string $date_create
 * @property string $date_update
 * @property string $date
 * @property integer $author_id
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        $behaviors = [];

        $behaviors[] = [
            'createdAtAttribute' => 'date_create',
            'updatedAtAttribute' => 'date_update',
            'class' => TimestampBehavior::className(),
            'value' => new Expression('NOW()')
        ];

        return $behaviors;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'author_id'], 'required'],
            [['date_create', 'date_update', 'date'], 'safe'],
            [['author_id'], 'integer'],
            [['name', 'preview'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'preview' => 'Preview',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'date' => 'Date',
            'author_id' => 'Author',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }
}
