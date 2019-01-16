<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "author".
 *
 * @property int $author_id
 * @property string $author_name
 * @property string $address
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $delete_logical
 *
 * @property BookAuthor[] $bookAuthors
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_name', 'address', 'status'], 'required','message'=>'Vui lòng nhập giá trị cho {attribute}.'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['author_name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'author_id' => 'Mã tác giả',
            'author_name' => 'Tên tác giả',
            'address' => 'Địa chỉ',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['author_id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['book_id' => 'book_id'])->viaTable('book_author', ['author_id' => 'author_id']);
    }

         /**
     * Get all the available categories (*4)
     * @return array available categories
     */
    public static function getAvailableAuthors()
    {
        $authors = self::find()->where(['status'=>1])->orderBy('author_name ASC')->asArray()->all();
        $items = ArrayHelper::map($authors, 'author_id', 'author_name');
        return $items;
    }
}
