<?php
namespace app\plugins\users;

use developeruz\yii_kit_core\base\Plugin;

class UsersPlugin extends Plugin
{
    public static function info()
    {
        return 'Yii2-user (c) Dektrium project (http://github.com/dektrium/)';
    }

    public static function uninstall()
    {
        return 'Please, read ReadMe.md "Uninstall" section for additional uninstall information';
    }

    public function init()
    {
        if(!\Yii::$app->user->isGuest) {
            $this->addAdminMenuItems();
        }
        $this->setPermissions();

    }

    private function setPermissions()
    {
        \Yii::$app->behaviors['AccessBehavior']->login_url = '/user/security/login';
        \Yii::$app->behaviors['AccessBehavior']->protect = array_merge(\Yii::$app->behaviors['AccessBehavior']->protect,
            ['user']);
        \Yii::$app->behaviors['AccessBehavior']->rules = array_merge(\Yii::$app->behaviors['AccessBehavior']->rules,
            ['user/security' => [['actions' => ['login'], 'allow' => true ],
                                 ['actions' => ['logout'], 'roles' => ['@'], 'allow' => true ]],
             'user/settings' => [['roles' => ['@'], 'allow' => true ]],
             'user/registration' => [['actions' => ['register'], 'allow' => true ]]
            ]);

    }

    private function addAdminMenuItems()
    {
        $this->addLeftMenuItem([
            'label' => 'Users',
            'icon' => 'fa fa-users',
            'url' => '/user/admin/index'
        ]);
    }
}
