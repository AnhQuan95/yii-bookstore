<?php

namespace backend\models;
use common\models\Customer;
use Yii;


/**
 * This is the model class for table "comment".
 *
 * @property int $cmt_id
 * @property string $book_id
 * @property int $customer_id
 * @property string $content
 * @property int $status
 * @property int $cmt_date
 *
 * @property Book $book
 * @property Customer $customer
 */
class Comment extends \yii\db\ActiveRecord
{
 public $verifyCode;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'status', 'cmt_date'], 'integer'],
            [['content'], 'required'],
            [['book_id'], 'string', 'max' => 50],
            [['content'], 'string', 'max' => 255],
            ['verifyCode', 'captcha'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'book_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmt_id' => 'Mã bình luận',
            'book_id' => 'Sách',
            'customer_id' => 'Khách hàng',
            'content' => 'Nội dung',
            'status' => 'Trạng thái',
            'cmt_date' => 'Ngày bình luận',
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
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
