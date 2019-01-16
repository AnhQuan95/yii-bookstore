<?php

namespace backend\models;
use backend\models\Book;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $cate_id
 * @property string $cate_name
 * @property int $parent
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Book[] $books
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
         //Khai báo phần tử của mảng
    private $cats = [];
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cate_name', 'status'], 'required','message'=>'Vui lòng nhập giá trị cho {attribute}.'],
            [['parent', 'status', 'created_at', 'updated_at'], 'integer'],
            [['cate_name'], 'string', 'max' => 100],
            [['cate_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
     return [
        'cate_id' => 'Mã danh mục',
        'cate_name' => 'Tên danh mục',
        'parent' => 'Danh mục cha',
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
        return $this->hasMany(Book::className(), ['cate_id' => 'cate_id']);
    }

    public function getParent($parent=0,$level='')
    {

        $data=Category::find()->where(['status'=>1,'parent'=>$parent])->all() ;
        $level.='-- ';
     //  echo '<pre>';
     //  print_r( $data);
     // echo '</pre>';
      //Khởi tạo giá trị của mảng _cats
        if($data):
            foreach ($data as $item) :
              if($item->parent==0){
                $level='';
            }
            
            $this->cats[$item->cate_id]=$level.$item->cate_name;
            $this->getParent($item->cate_id,$level);
        endforeach;
    endif;

    return $this->cats;
}

public function getCategoryBy($parent=0)
{

   $data=Category::find()->where(['parent'=>$parent,'status'=>1])->all();
   return $data;
}

public function countBooks($cate_id)
{
    $book=new Book();
    $dataSub=$this->getCategoryBy($cate_id);
    $count=0;
    if($dataSub):
        $count=$book->getQuantityByCat($cate_id);
    else:
        $data= Book::find()->where(['cate_id'=>$cate_id])->all();
        $count=count($data);
    endif;
    return $count;
}



}
