<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "suitable_age".
 *
 * @property int $id
 * @property string $name_of_age
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $delete_logical
 *
 * @property Book[] $books
 */
class SuitableAge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suitable_age';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_of_age', 'status'], 'required','message'=>'Vui lòng nhập giá trị cho {attribute}.'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name_of_age'], 'string', 'max' => 200],
            [['name_of_age'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Mã tuổi',
            'name_of_age' => 'Độ tuổi',
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
        return $this->hasMany(Book::className(), ['age_id' => 'id']);
    }

        public function getSuitableAgeBy()
    {

       $data=SuitableAge::find()->where(['status'=>1])->all();
       return $data;
}

}
