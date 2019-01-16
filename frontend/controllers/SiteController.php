<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\CustomerLoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\CustomerSignupForm;
use frontend\models\AdminSignupForm;
use frontend\models\CustomerUpdateForm;
use frontend\models\ContactForm;
use backend\models\Contact;
use backend\models\BookWithAuthor;
use backend\models\Whilist;
use backend\models\News;
use yii\db\Query;

/**
* Site controller
*/
class SiteController extends Controller
{
/**
 * {@inheritdoc}
 */
public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::className(),
            'only' => ['logout', 'signup'],
            'rules' => [
                [
                    'actions' => ['signup'],
                    'allow' => true,
                    'roles' => ['?'],
                ],
                [
                    'actions' => ['logout'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ],
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'logout' => ['post'],
            ],
        ],
    ];
}

/**
 * {@inheritdoc}
 */
public function actions()
{
    return [
        'error' => [
            'class' => 'yii\web\ErrorAction',
        ],
        'captcha' => [
            'class' => 'yii\captcha\CaptchaAction',
            'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
        ],
    ];
}

/**
 * Displays homepage.
 *
 * @return mixed
 */
public function actionIndex()
{   

   $whilist=new Whilist();
   $book=new BookWithAuthor();
   $news=new News();
   $suitable_books='';

// Lấy thông tin sách
   $new_books=$book->getNewBooks();
   $sale_books=$book->getSaleBooks();
   $hot_books=$book->getHotBooks();
   $news=$news->getNews();


 //Đưa ra sách phù hợp với độ tuổi của khách hàng
   if(!Yii::$app->user->isGuest):

    $time = strtotime(Yii::$app->user->identity->birthday);
    $newformat = date('Y',$time);

    $current_year=(int)(string)date('Y');
    $year_birthday=(int)(string)$newformat;
    $age=$current_year-$year_birthday;

    if($age<6):
        $suitable_books=$book->getSuitableBooks(1);
    elseif($age>=6&&$age<11):
      $suitable_books=$book->getSuitableBooks(2);
  elseif($age>=11&&$age<15):
      $suitable_books=$book->getSuitableBooks(3);
  elseif($age>=15&&$age<18):
      $suitable_books=$book->getSuitableBooks(4);
  else:
    $suitable_books=$book->getSuitableBooks(5);
endif;

endif;
return $this->render('index',[
    'suitable_books'=>$suitable_books,
    'new_books'=>$new_books,
    'sale_books'=>$sale_books,
    'hot_books'=>$hot_books,
    'whilist'=>$whilist,
    'news'=>$news

]
);


}

/**
 * Logs in a user.
 *
 * @return mixed
 */
public function actionLogin()
{

   //DÙng layout mặc định là login
 $this->layout='login';

 if (!Yii::$app->user->isGuest) {
    return $this->goHome();
}

$model = new CustomerLoginForm();
$modelRegister =  new CustomerSignupForm();



if ($model->load(Yii::$app->request->post())&&$model->login()) {
    return $this->goBack();
} else {
    $model->password = '';

    return $this->render('login', [
        'model' => $model,
        'modelRegister' => $modelRegister
    ]);
}
}

/**
 * Logs out the current user.
 *
 * @return mixed
 */
public function actionLogout()
{
    Yii::$app->user->logout();

    return $this->goHome();
}

/**
 * Displays contact page.
 *
 * @return mixed
 */
public function actionContact()
{
    $model = new Contact();

    if ($model->load(Yii::$app->request->post())) {
        echo '123';
        $model->created_at=time();
        $model->updated_at=time();
        $model->status=0;
        if($model->save())
        {
          Yii::$app->session->setFlash('success', 'Cảm ơn bạn đã liên hệ với chúng tôi. Chung tôi sẽ trả lời sớm nhất có thể.');
      }


      return $this->refresh();
  } else {
    return $this->render('contact', [
        'model' => $model,
    ]);
}
}

/**
 * Displays about page.
 *
 * @return mixed
 */
public function actionAbout()
{
    return $this->render('about');
}

public function actionGuide()
{
    return $this->render('guide');
}

/**
 * Signs user up.
 *
 * @return mixed
 */
public function actionSignup()
{
 $this->layout='login';

 $model = new CustomerSignupForm();
 if ($model->load(Yii::$app->request->post())) {
    $model->birthday=date("Y-m-d",strtotime($model->birthday));

        // var_dump($user = $model->signup());
        // die;

    if ($user = $model->signup()) {

        if (Yii::$app->getUser()->login($user)) {
            return $this->goHome();
        }
    }
}

return $this->render('signup', [
    'model' => $model,
]);
}

// public function actionSignup()
// {

//     $model = new AdminSignupForm();
//     if ($model->load(Yii::$app->request->post())) {
//        // $model->birthday=date("Y-m-d",strtotime($model->birthday));

//         // var_dump($user = $model->signup());
//         // die;

//         if ($user = $model->signup()) {

//             if (Yii::$app->getUser()->login($user)) {
//                 return $this->goHome();
//             }
//         }
//     }

//     return $this->render('adminsignup', [
//         'model' => $model,
//     ]);
// }



/**
 * Requests password reset.
 *
 * @return mixed
 */
public function actionRequestPasswordReset()
{
    $model = new PasswordResetRequestForm();
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        if ($model->sendEmail()) {
            Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

            return $this->goHome();
        } else {
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }
    }

    return $this->render('requestPasswordResetToken', [
        'model' => $model,
    ]);
}

/**
 * Resets password.
 *
 * @param string $token
 * @return mixed
 * @throws BadRequestHttpException
 */
public function actionResetPassword($token)
{
    try {
        $model = new ResetPasswordForm($token);
    } catch (InvalidParamException $e) {
        throw new BadRequestHttpException($e->getMessage());
    }

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
        Yii::$app->session->setFlash('success', 'New password saved.');

        return $this->goHome();
    }

    return $this->render('resetPassword', [
        'model' => $model,
    ]);
}
}
