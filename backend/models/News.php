<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $news_id
 * @property string $news_title
 * @property string $image
 * @property string $description
 * @property string $content
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_title', 'image', 'description', 'content', 'status'], 'required','message'=>'Vui lòng nhập giá trị cho {attribute}.'],
            [['content'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['news_title'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'Mã tin tức',
            'news_title' => 'Tiêu đề tin tức',
            'image' => 'Ảnh',
            'description' => 'Mô tả ngắn',
            'content' => 'Nội dung',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
        ];
    }

    public function getNews()
    {
         $data=News::find()->orderBy('created_at DESC')->limit(3)->andWhere(['!=','status',0])->all();
         return $data;
    }
}
