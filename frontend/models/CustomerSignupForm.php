<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Customer;

/**
 * Signup form
 */
class CustomerSignupForm extends Model
{
    //public $username;
    public $email;
    public $password;
    public $full_name;
    public $phone;
    public $address;
    public $birthday;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // ['username', 'trim'],
            // ['username', 'required'],
            // ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            // ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'email', 'message' => 'Địa chỉ email này không hợp lệ'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Customer', 'message' => 'Địa chỉ email này đã được sử dụng.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            [['full_name','phone','address','birthday','email'], 'required']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        // var_dump($this);
        if (!$this->validate()) {
            return null;
        }

        $user = new Customer();
        //$user->username = $this->username;
        $user->email = $this->email;
        $user->full_name = $this->full_name;
        $user->phone = $this->phone;
        $user->address = $this->address;
        $user->birthday = $this->birthday;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }


   public function findModel($id)
   {
    if (($model = Customer::findOne($id)) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

}
