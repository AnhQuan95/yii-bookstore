<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body', 'status'], 'required','message'=>'Vui lòng nhập giá trị cho {attribute}.'],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['name', 'email'], 'string', 'max' => 100],
            [['subject', 'body'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'email' => 'Email',
            'subject' => 'Tiêu đề',
            'body' => 'Nội dung',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
            'status' => 'Trạng thái',
        ];
    }
}
