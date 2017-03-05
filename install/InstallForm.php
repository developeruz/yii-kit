<?php
namespace app\install;

use Yii;
use yii\base\Model;

class InstallForm extends Model
{
    public $root_password;
    public $root_email = '';
    public $root_login = '';

    public function rules()
    {
        return [
            [['root_password', 'root_email', 'root_login'], 'required'],
            ['root_password', 'string', 'min' => 6],
            [['root_email'], 'email'],
            [['root_password', 'root_email', 'root_login'], 'trim'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'root_password' => Yii::t('app', 'Root password'),
            'root_email' => Yii::t('app', 'Root email'),
            'root_login' => Yii::t('app', 'Root login')
        ];
    }
}
