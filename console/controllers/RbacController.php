<?php 
namespace console\controllers;

use Yii;
//Controller
use yii\console\Controller;
/**
 * 
 */
class RbacController extends Controller
{
	
	public function actionInit($value='')
	{
		$auth=Yii::$app->authManager;
		$auth->removeAll();

		//Thêm permission(quyền) type=2
		//Tên biến : $createPost
		//Tên aciton và tên controller : create-post

		$createPost=$auth->createPermission('create-post');
		$createPost->description='Create a post';
		$auth->add($createPost);

		$indexPost=$auth->createPermission('index-post');
		$indexPost->description='Xem danh sách bài viết';
		$auth->add($indexPost);

		$updatePost=$auth->createPermission('update-post');
		$updatePost->description='Chỉnh sửa bài viết';
		$auth->add($updatePost);

		$viewPost=$auth->createPermission('view-post');
		$viewPost->description='Xem chi tiết bài viết';
		$auth->add($viewPost);

		$deletePost=$auth->createPermission('delete-post');
		$deletePost->description='Xóa bài viết';
		$auth->add($deletePost);

		//Thêm role ( vai trò : Admin , Editor ) .type =1 
		$postManager=$auth->createRole('manager-post');
		$auth->add($postManager);

		// Gán permission cho role 
		$auth->addChild($postManager,$createPost);
		$auth->addChild($postManager,$indexPost);
		$auth->addChild($postManager,$updatePost);
		$auth->addChild($postManager,$viewPost);
		$auth->addChild($postManager,$deletePost);

		//Thêm permission
		$indexBook=$auth->createPermission('index-book');
		$indexBook->description='Xem sản phẩm';
		$auth->add($indexBook);

	

		//Thêm role
		$bookManager=$auth->createRole('manager-book');
		$auth->add($bookManager);
		$auth->addChild($bookManager,$indexBook);

		$admin=$auth->createRole('admin');
		$auth->add($admin);
		$auth->addChild($admin,$bookManager);
		$auth->addChild($admin,$postManager);


		//Gán cho người dùng
		$auth->assign($admin,2);
		$auth->assign($postManager,1);
		$auth->assign($bookManager,3);


	}
}
?>