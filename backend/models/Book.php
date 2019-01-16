<?php

namespace backend\models;

use Yii;
use yii\data\Pagination;
/**
 * This is the model class for table "book".
 *
 * @property string $book_id
 * @property string $book_name
 * @property int $cate_id
 * @property int $age_id
 * @property string $image
 * @property string $description
 * @property string $content
 * @property double $price
 * @property double $sale_price
 * @property int $quantity
 * @property int $pages
 * @property string $size
 * @property int $publisher_id
 * @property string $publish_at
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $delete_logical
 *
 * @property Category $cate
 * @property SuitableAge $age
 * @property Publisher $publisher
 * @property BookAuthor[] $bookAuthors
 * @property Author[] $authors
 * @property Comment[] $comments
 * @property OrderDetail[] $orderDetails
 * @property Order[] $orders
 * @property Whilist[] $whilists
 */
class Book extends \yii\db\ActiveRecord
{
 public $quantity_in_cart;
 public $discount_rate;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
      return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
      return [
        [['book_id', 'book_name', 'content', 'price', 'sale_price', 'quantity', 'pages', 'publish_at', 'status'], 'required','message'=>'Vui lòng nhập giá trị cho {attribute}.'],
        [['cate_id', 'age_id', 'quantity', 'pages', 'publisher_id', 'status', 'created_at', 'updated_at'], 'integer'],
        [['cate_id','age_id','publisher_id','size','image'],'required'],
        [['content'], 'string'],
        [['price', 'sale_price'], 'number'],
        [['publish_at'], 'safe'],
        [['book_id'], 'string', 'max' => 50],
        [['book_name'], 'string', 'max' => 200],
        [['image', 'size'], 'string', 'max' => 255],
        [['description'], 'string', 'max' => 150],
        [['book_id'], 'unique'],
        [['cate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cate_id' => 'cate_id']],
        [['age_id'], 'exist', 'skipOnError' => true, 'targetClass' => SuitableAge::className(), 'targetAttribute' => ['age_id' => 'id']],
        [['publisher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publisher::className(), 'targetAttribute' => ['publisher_id' => 'publisher_id']],
      ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
      return [
        'book_id' => 'Book ID',
        'book_name' => 'Tên',
        'cate_id' => 'Danh mục',
        'age_id' => 'Độ tuổi',
        'image' => 'Ảnh',
        'description' => 'Mô tả ngắn',
        'content' => 'Nội dung',
        'price' => 'Giá',
        'sale_price' => 'Giá KM',
        'quantity' => 'Số lượng',
        'pages' => 'Số trang',
        'size' => 'Kích thước',
        'publisher_id' => 'NXB',
        'publish_at' => 'Ngày phát hành',
        'status' => 'Trạng thái',
        'created_at' => 'Ngày tạo',
        'updated_at' => 'Ngày cập nhật',
      ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCate()
    {
      return $this->hasOne(Category::className(), ['cate_id' => 'cate_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAge()
    {
      return $this->hasOne(SuitableAge::className(), ['id' => 'age_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
      return $this->hasOne(Publisher::className(), ['publisher_id' => 'publisher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
      return $this->hasMany(BookAuthor::className(), ['book_id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
      return $this->hasMany(Author::className(), ['author_id' => 'author_id'])->viaTable('book_author', ['book_id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
      return $this->hasMany(Comment::className(), ['book_id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
      return $this->hasMany(OrderDetail::className(), ['book_id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
      return $this->hasMany(Order::className(), ['order_id' => 'order_id'])->viaTable('order_detail', ['book_id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWhilists()
    {
      return $this->hasMany(Whilist::className(), ['book_id' => 'book_id']);
    }

    public function getQuantityByCat($cate_id)
    {
      $cate=Category::find()->where(['cate_id'=>$cate_id])->andWhere(['!=','status',0])->one();
      if($cate->parent==0){
        $sub_cate=Category::find()->where(['parent'=>$cate_id])->andWhere(['!=','status',0])->all();
        if (count($sub_cate)>0){
          $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$sub_cate])->orderBy('book_name ASC')->all();
        }
        else{
          $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$cate_id])->orderBy('book_name ASC')->all();
        }

      }

      else
      {
        $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$cate_id])->orderBy('book_name ASC')->all();
      }
      return count($data);
    }

    public function getQuantityByPublisher($keyword)
    {
     $publisher= Publisher::find()->select('publisher_id')->where(['like','publisher_name',$keyword])->andWhere(['!=','status',0])->all();
     $data=Book::find()->where(['!=','status',0])->andWhere(['publisher_id'=>$publisher])->all();

     return count($data);

   }

   public function getQuantityByBook($keyword)
   {
     $data=Book::find()->where(['!=','status',0])->andWhere(['like','book_name',$keyword])->all();
     return count($data);
   }

   public function getQuantityByAuthor($keyword)
   {
    $author= Author::find()->select('author_id')->where(['like','author_name',$keyword])->andWhere(['!=','status',0]);
    $book_author=BookAuthor::find()->select('book_id')->where(['author_id'=>$author]);
    $data=Book::find()->where(['!=','status',0])->andWhere(['book_id'=>$book_author])->all();
    return count($data);
  }


  public function getQuantityByAge($age_id)
  {
    $data=Book::find()->where(['!=','status',0])->andWhere(['age_id'=>$age_id])->orderBy('book_name ASC')->all();
    return count($data);
  }

  public function getQuantityByPrice($cate,$price_from,$price_to)
  {
   $cate= Category::find()->select('cate_id')->where(['cate_id'=>$cate])->andWhere(['!=','status',0])->one();
   $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$cate->cate_id])->andwhere(['between', 'sale_price', $price_from, $price_to])->all();
   return count($data);
 }

 public function getDataBook()
 {
  $pages=$this->getPagesNewBook();
  $data=Book::find()->where(['!=','status',0])->offset($pages->offset)->orderBy('created_at DESC')->limit($pages->limit)->all();
  return $data;
}

public function getBookByCat($cate_id)
{
  $pages=$this->getPagesBook($cate_id);
  $cate=Category::find()->where(['cate_id'=>$cate_id])->andWhere(['!=','status',0])->one();
  if($cate->parent==0){
    $sub_cate=Category::find()->where(['parent'=>$cate_id])->andWhere(['!=','status',0])->all();
    if (count($sub_cate)>0){
      $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$sub_cate])->offset($pages->offset)->limit($pages->limit)->orderBy('book_name ASC')->all();
    }
    else{
      $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$cate_id])->offset($pages->offset)->limit($pages->limit)->orderBy('book_name ASC')->all();
    }

  }

  
  else
  {
    $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$cate_id])->offset($pages->offset)->limit($pages->limit)->orderBy('book_name ASC')->all();
  }
  return $data;
}

public function getBookByAge($age_id)
{
  $pages=$this->getPagesBookByAge($age_id);
  $data=Book::find()->where(['!=','status',0])->andWhere(['age_id'=>$age_id])
  ->offset($pages->offset)->orderBy('book_name ASC')->limit($pages->limit)->all();
  return $data;
}

public function getBookByBookName($keyword){
  $pages=$this->getPagesBookByBookName($keyword);
  $data=Book::find()->where(['!=','status',0])->andWhere(['like','book_name',$keyword])->offset($pages->offset)->limit($pages->limit)->all();
  return $data;
}

public function getBookByAuthorName($keyword){
  $pages=$this->getPagesBookByAuthorName($keyword);
  $author= Author::find()->select('author_id')->where(['like','author_name',$keyword])->andWhere(['!=','status',0]);
  // $query=Author::find()->select('author_id')->where(['like','author_name',$keyword])->andWhere(['!=','status',0]);
  // echo $query->createCommand()->getRawSql(); 
  $book_author=BookAuthor::find()->select('book_id')->where(['author_id'=>$author]);
  // echo $book_author->createCommand()->getRawSql(); 
  $data=Book::find()->where(['!=','status',0])->andWhere(['book_id'=>$book_author])->offset($pages->offset)->limit($pages->limit)->all();

  return $data;
}

public function getBookByPublisherName($keyword){
  $pages=$this->getPagesBookByPublisherName($keyword);

  $publisher= Publisher::find()->select('publisher_id')->where(['like','publisher_name',$keyword])->andWhere(['!=','status',0])->all();
  $data=Book::find()->where(['!=','status',0])->andWhere(['publisher_id'=>$publisher])->offset($pages->offset)->limit($pages->limit)->all();


  return $data;
  //return $data;
}

public function getBookByPrice($cate,$price_from,$price_to){
 
   $pages=$this->getPagesBookByPrice($cate,$price_from,$price_to);
    $cate= Category::find()->select('cate_id')->where(['cate_id'=>$cate])->andWhere(['!=','status',0])->one();
  $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$cate->cate_id])->andwhere(['between', 'price', $price_from, $price_to])->offset($pages->offset)->limit($pages->limit)->all();
  

 
  return $data;
}

public function getPagesBook($cate_id)
{

 $cate=Category::find()->where(['cate_id'=>$cate_id])->andWhere(['!=','status',0])->one();
 if($cate->parent==0){
  $sub_cate=Category::find()->where(['parent'=>$cate_id])->andWhere(['!=','status',0])->all();
  if (count($sub_cate)>0){
    $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$sub_cate])->orderBy('book_name ASC')->all();
  }
  else{
    $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$cate_id])->orderBy('book_name ASC')->all();
  }

}


else
{
  $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$cate_id])->orderBy('book_name ASC')->all();
}

            //mỗi trang 6 sản phẩm
$pages=new Pagination(['totalCount'=>count($data),'pageSize'=>6]);
return $pages;
}

public function getPagesNewBook()
{
  $data=Book::find()->where(['!=','status',0])->orderBy('created_at DESC')->all();

            //mỗi trang 6 sản phẩm
  $pages=new Pagination(['totalCount'=>count($data),'pageSize'=>6]);
  return $pages;
}

public function getPagesBookByAge($age_id)
{
  $data=Book::find()->where(['!=','status',0])->andWhere(['age_id'=>$age_id])->orderBy('book_name ASC')->all();
            //mỗi trang 6 sản phẩm
  $pages=new Pagination(['totalCount'=>count($data),'pageSize'=>6]);
  return $pages;
}

public function getPagesBookByPrice($cate,$price_from,$price_to)
{
  
    

  $cate= Category::find()->select('cate_id')->where(['cate_id'=>$cate])->andWhere(['!=','status',0])->one();
   $data=Book::find()->where(['!=','status',0])->andWhere(['cate_id'=>$cate->cate_id])->andwhere(['between', 'price', $price_from, $price_to])->all();
            //mỗi trang 6 sản phẩm
  $pages=new Pagination(['totalCount'=>count($data),'pageSize'=>6]);
  return $pages;
}

public function getPagesBookByPublisherName($keyword)
{
 $publisher= Publisher::find()->select('publisher_id')->where(['like','publisher_name',$keyword])->andWhere(['!=','status',0])->all();
 $data=Book::find()->where(['!=','status',0])->andWhere(['publisher_id'=>$publisher])->all();
            //mỗi trang 6 sản phẩm
 $pages=new Pagination(['totalCount'=>count($data),'pageSize'=>6]);
 return $pages;
}

public function getPagesBookByAuthorName($keyword)
{

  $author= Author::find()->select('author_id')->where(['like','author_name',$keyword])->andWhere(['!=','status',0])->one();
  $book_author=BookAuthor::find()->select('book_id')->where(['author_id'=>$author->author_id]);
  $data=Book::find()->where(['!=','status',0])->andWhere(['book_id'=>$book_author])->all();
            //mỗi trang 6 sản phẩm
  $pages=new Pagination(['totalCount'=>count($data),'pageSize'=>6]);
  return $pages;
}

public function getPagesBookByBookName($keyword)
{

 $data=Book::find()->where(['!=','status',0])->andWhere(['like','book_name',$keyword])->all();
            //mỗi trang 6 sản phẩm
 $pages=new Pagination(['totalCount'=>count($data),'pageSize'=>6]);
 return $pages;
}



public function getNewBooks()
{
  $data=BookWithAuthor::find()->select(['*','(price-sale_price)*100/price AS discount_rate'])->orderBy('created_at DESC')->andWhere(['!=','status',0])->limit(20)->all();
  return $data;
}

public function getSaleBooks()
{
  $data=BookWithAuthor::find()->select(['*','(price-sale_price)*100/price AS discount_rate'])->where(['!=','sale_price',0])->andWhere(['!=','status',0])->orderBy('discount_rate DESC')->limit(20)->all();
  return $data;
}

public function getHotBooks()
{
  $data=BookWithAuthor::find()->select(['*','(price-sale_price)*100/price AS discount_rate'])->orderBy('book_name ASC')->where(['status'=>2])->limit(20)->all();
  return $data;
}

public function getSuitableBooks($age_id)
{
  $data=BookWithAuthor::find()->select(['*','(price-sale_price)*100/price AS discount_rate'])->orderBy('book_name ASC')->where(['age_id'=>$age_id])->andWhere(['!=','status',0])->all();  
  return $data;
}

}


