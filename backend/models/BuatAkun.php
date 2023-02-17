<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Guru;
use common\models\AuthAssignment;
use common\models\Siswa;

class BuatAkun extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup($id, $status)
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->status = 10;
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();

        if ($status == "Siswa") {
            $lastInsertedId = Yii::$app->db->getLastInsertID();
            $createSiswa = Siswa::findOne($id);
            $createSiswa->id_user = $lastInsertedId;
            $createSiswa->save();

            $modelAuth = new AuthAssignment();
            $modelAuth->item_name = 'Siswa';
            $modelAuth->user_id = $lastInsertedId;
            $modelAuth->save();
        }elseif ($status == "Guru") {
            $lastInsertedId = Yii::$app->db->getLastInsertID();
            $createGuru = Guru::findOne($id);
            $createGuru->id_user = $lastInsertedId;
            $createGuru->save();

            $modelAuth = new AuthAssignment;
            $modelAuth->item_name = 'Guru';
            $modelAuth->user_id = $lastInsertedId;
            $modelAuth->save();
        }

        return true;
    }

}