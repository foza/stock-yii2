<?php

namespace app\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $fullname
 * @property string $auth_key
 * @property string $password
 * @property string $password_reset_token
 * @property string $email
 * @property string $avatar
 * @property string $phone_number
 * @property string $facebook_id
 * @property string $twitter_id
 * @property string $instagram_id
 * @property string $bilim
 * @property string $don
 * @property string $current_bilim
 * @property double $visit_count
 * @property string $last_visit
 * @property string $user_lang
 * @property string $theme
 * @property integer $favorite
 * @property string $status
 * @property string $ask_questions
 * @property string $no_ask_questions
 * @property string $created_at
 * @property string $access_token
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','fullname','phone_number'],'required', 'on'=>'registration'],
            [['type','username','fullname','email','phone_number','facebook_id'],'required', 'on'=>'facebook-registration'],
            [['type','username','fullname','email','twitter_id'],'required', 'on'=>'twitter-registration'],
            
            ['username', 'unique','on'=>'registration'],
            ['phone_number', 'unique','on'=>'registration'],
            /*[['username', 'fullname',  'auth_key', 'password', 'password_reset_token', 'email', 'avatar', 'phone_number', 'facebook_id', 'twitter_id', 'instagram_id', 'bilim', 'don', 'current_bilim', 'visit_count', 'last_visit', 'user_lang', 'theme', 'favorite', 'status', 'ask_questions', 'no_ask_questions', 'created_at', 'access_token'], 'required'],*/
            [['visit_count'], 'number'],
            [['last_visit', 'created_at'], 'safe'],
            [['favorite'], 'integer'],
            [['ask_questions', 'no_ask_questions'], 'string'],
            //[['avatar'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['username', 'fullname','auth_key', 'password', 'password_reset_token', 'email', 'avatar', 'phone_number', 'facebook_id', 'twitter_id', 'instagram_id', 'bilim', 'don', 'current_bilim', 'user_lang', 'theme', 'status', 'access_token'], 'string', 'max' => 254],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'fullname' => Yii::t('app', 'Firstname'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password' => Yii::t('app', 'Password'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'avatar' => Yii::t('app', 'Avatar'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'facebook_id' => Yii::t('app', 'Facebook ID'),
            'twitter_id' => Yii::t('app', 'Twitter ID'),
            'instagram_id' => Yii::t('app', 'Instagram ID'),
            'bilim' => Yii::t('app', 'Bilim'),
            'don' => Yii::t('app', 'Don'),
            'current_bilim' => Yii::t('app', 'Current Bilim'),
            'visit_count' => Yii::t('app', 'Visit Count'),
            'last_visit' => Yii::t('app', 'Last Visit'),
            'user_lang' => Yii::t('app', 'User Lang'),
            'theme' => Yii::t('app', 'Theme'),
            'favorite' => Yii::t('app', 'Favorite'),
            'status' => Yii::t('app', 'Status'),
            'ask_questions' => Yii::t('app', 'Ask Questions'),
            'no_ask_questions' => Yii::t('app', 'No Ask Questions'),
            'created_at' => Yii::t('app', 'Created At'),
            'access_token' => Yii::t('app', 'Access Token'),
        ];
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findIdentityByUsername($username)
    {
        $_user = static::findOne(['username' => $username,'type'=>'mobile']);
        if($_user === null){
            $_user = static::findOne(['phone_number'=>$username,'type'=>'mobile']);
        }
        return $_user;
    }
 
    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }
 
    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
 
    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
 
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
                $this->created_at = date("Y-m-d H:i:s");
                $this->access_token = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    public function upload()
    {
        /*if($this->avatar->saveAs('/var/www/server/data/www/bilimdon.teasoft.uz/api/uploads/user_' . $this->username . '.' . $this->avatar->extension)){
            Image::thumbnail('/var/www/server/data/www/bilimdon.teasoft.uz/api/uploads/user_'.$this->username.'.'.$this->avatar->extension, 300, 300)
                ->save(Yii::getAlias('/var/www/server/data/www/bilimdon.teasoft.uz/api/uploads/user_100x100_'.$this->username.'.'.$this->avatar->extension), ['quality' => 100]);
        */
        if($this->avatar->saveAs('e:\OpenServer\domains\bilimdon\api\uploads\user_' . $this->username . '.' . $this->avatar->extension)){
            Image::thumbnail('e:\OpenServer\domains\bilimdon\api\uploads\user_'.$this->username.'.'.$this->avatar->extension, 300, 300)
                ->save(Yii::getAlias('e:\OpenServer\domains\bilimdon\api\uploads\user_100x100_'.$this->username.'.'.$this->avatar->extension), ['quality' => 100]);
            return true;
        } else {
            return false;
        }
    }

}
