<?php 
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\BookWithAuthor;
use backend\models\BookAuthor;
use backend\models\Comment;
use backend\models\Whilist;
use frontend\models\ContactForm;

/**
 * 
 */
class BookController extends Controller
{

	public function actionIndex()
	{
		$this->layout='book';
		$data=new BookWithAuthor();
		$books=$data->getDataBook();
		$pages=$data->getPagesNewBook();
		
		$whilist=new Whilist();
		
		return $this->render('index',
			[
				'books'=>$books,
				'pages'=>$pages
			]);
	}
	public function actionView($id)
	{

		$model=BookWithAuthor::findOne(['book_id'=>$id]);
		//Hiển thị tác giả
		$model->loadAuthors();

		//Hiển thị các thông tin khác ở trang chi tiết
		$book_author=BookAuthor::find()->select('book_id')->where(['author_id'=>$model->author_ids]);
		$book_with_author=BookWithAuthor::find()->where(['book_id'=>$book_author])->andWhere(['!=','status',0])->andWhere(['!=','book_id',$id])->all();
		$hot_books=BookWithAuthor::find()->where(['status'=>2])->andWhere(['!=','book_id',$id])->limit(5)->all();
		$comment=new Comment();
		$comments=Comment::find()->where(['book_id'=>$id,'status'=>1])->all();
		$whilist=new whilist();

		//Nếu là thành viên , xác nhận sản phẩm có trong danh sách yêu thích hay không
		if(!Yii::$app->user->isGuest):
			$bookInList=$whilist->getBookInList($id);
			return $this->render('view',
				[
					'model'=>$model,
					'book_with_author'=>$book_with_author,
					'hot_books'=>$hot_books,
					'comment'=>$comment,
					'comments'=>$comments,		
					'whilist'=>$whilist,
					'bookInList'=>$bookInList

				]);
		endif;


		//Gửi dữ liệu tới view tương ứng
		return $this->render('view',
			[
				'model'=>$model,
				'book_with_author'=>$book_with_author,
				'hot_books'=>$hot_books,
				'comment'=>$comment,
				'comments'=>$comments,		
				'whilist'=>$whilist

			]);

	}

	public function actionListByCategory($id)
	{
		$this->layout='book';
		$data=new BookWithAuthor();
		$books=$data->getBookByCat($id);
		// var_dump($books);
		// die;
		$pages=$data->getPagesBook($id);
		return $this->render('list-by',
			[
				'books'=>$books,
				'pages'=>$pages
			]);
	}

	public function actionListByAge($id)
	{
		$this->layout='book';
		$data=new BookWithAuthor();
		$books=$data->getBookByAge($id);
		$pages=$data->getPagesBookByAge($id);



		return $this->render('list-by',
			[
				'books'=>$books,
				'pages'=>$pages
			]);
	}

	public function actionListByPrice()
	{
		$this->layout='book';
		$data=new BookWithAuthor();
		$count=0;

		if(Yii::$app->request->get())
		{
				
	
			$cate_id=Yii::$app->request->get()['cate'];
			$price_from=Yii::$app->request->get()['price_from'];
			$price_to=Yii::$app->request->get()['price_to'];
			$data=new BookWithAuthor();
			$books=$data->getBookByPrice($cate_id,$price_from,$price_to);
			
			$count=$data->getQuantityByPrice($cate_id,$price_from,$price_to);
			$pages=$data->getPagesBookByPrice($cate_id,$price_from,$price_to);
			return $this->render('list-by',
				[
					'books'=>$books,
					'pages'=>$pages,
					'count'=>$count
				]);
		}

		
		
	}
	public function actionListByKeyWord()
	{
		$this->layout='book';
		$data=new BookWithAuthor();
		$count=0;

		//var_dump(['type']);
		//die;
		if(Yii::$app->request->get()){
			$type=Yii::$app->request->get()['type'];
			$keyword=Yii::$app->request->get()['keyword'];
			if($type=='book')
			{
				$books=$data->getBookByBookName($keyword);
				$count=$data->getQuantityByBook($keyword);
				$pages=$data->getPagesBookByBookName($keyword);
			}
			else if($type=='publisher')
			{
				$books=$data->getBookByPublisherName($keyword);
				$count=$data->getQuantityByPublisher($keyword);
				$pages=$data->getPagesBookByPublisherName($keyword);
			}

			else{
				$books=$data->getBookByAuthorName($keyword);
				 // var_dump($books);
				 // die;
				$count=$data->getQuantityByAuthor($keyword);
				$pages=$data->getPagesBookByAuthorName($keyword);
			}
			return $this->render('list-by',
				[
					'books'=>$books,
					'pages'=>$pages,
					'keyword'=>$keyword,
					'count'=>$count
				]);
		}
		else{
			return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
		}

	}

}