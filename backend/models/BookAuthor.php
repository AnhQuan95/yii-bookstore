<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "book_author".
 *
 * @property string $book_id
 * @property int $author_id
 *
 * @property Book $book
 * @property Author $author
 */
class BookAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'book_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'author_id'], 'required'],
            [['author_id'], 'integer'],
            [['book_id'], 'string', 'max' => 50],
            [['book_id', 'author_id'], 'unique', 'targetAttribute' => ['book_id', 'author_id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'book_id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'author_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Sách',
            'author_id' => 'Tác giả',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['book_id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['author_id' => 'author_id']);
    }
}
