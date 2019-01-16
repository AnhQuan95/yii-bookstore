<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "publisher".
 *
 * @property int $publisher_id
 * @property string $publisher_name
 * @property string $address
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $delete_logical
 *
 * @property Book[] $books
 */
class Publisher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publisher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publisher_name', 'address', 'status'], 'required','message'=>'Vui lòng nhập giá trị cho {attribute}.'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['publisher_name', 'address'], 'string', 'max' => 100],
            [['publisher_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
       return [
        'publisher_id' => 'Mã NXB',
        'publisher_name' => 'Tên NXB',
        'address' => 'Địa chỉ',
        'status' => 'Trạng thái',
        'created_at' => 'Ngày tạo',
        'updated_at' => 'Ngày cập nhật',
    ];
}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['publisher_id' => 'publisher_id']);
    }

}
