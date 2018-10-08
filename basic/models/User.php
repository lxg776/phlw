<?php

namespace app\models;


class User extends BaseBean implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $sex;




    public static function tableName(){
        return 'ucenter_user';
    }



    /**
     * @inheritdoc
     */
    public static function findIdentity($id)

    {
        $user =new User();

        $query = \Yii::$app->getDb()->createCommand("select u.*,t.access_token from ucenter_user as u left JOIN ucenter_user_token as t on u.user_id = t.user_id where u.user_id = :user_id ",[':user_id' => $id])->queryOne();
        //  $query = Yii::$app->getDb()->createCommand("select u.*,t.access_token from ucenter_user as u left JOIN ucenter_user_token as t on u.user_id = t.user_id where t.access_token = :token ",[':token' => $token])->queryAll();
        $length = sizeof($query);
        if($length>1){
            $user->id = $query['user_id'];
            $user->username= $query['user_name'];
            $user->accessToken = $query['access_token'];
            $user->password  = $query['password'];
            $user->sex = $query['sex'];
            return $user;
        }

        return null;

    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        $user =new User();

        $query = \Yii::$app->getDb()->createCommand("select u.*,t.access_token from ucenter_user as u left JOIN ucenter_user_token as t on u.user_id = t.user_id where t.access_token = :token ",[':token' => $token])->queryOne();
      //  $query = Yii::$app->getDb()->createCommand("select u.*,t.access_token from ucenter_user as u left JOIN ucenter_user_token as t on u.user_id = t.user_id where t.access_token = :token ",[':token' => $token])->queryAll();
        $length = sizeof($query);
        if($length>1){
            $user->id = $query['user_id'];
            $user->username= $query['user_name'];
            $user->accessToken = $query['access_token'];
            $user->password  = $query['password'];
            $user->sex = $query['sex'];
            return $user;
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $result = UcenterUser::find()->where(['user_name' => $username])->all();
        $length = sizeof($result);

        if($length>0){
            $array = self::result2Array($result);

           // $t  = json_decode(json_encode($array));

            $bean = new User();


            $bean->username = $array[0]['user_name'];
            $bean->password = $array[0]['password'];

            return $bean;
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
