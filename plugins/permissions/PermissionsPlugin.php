<?php
namespace app\plugins\permissions;

use developeruz\yii_kit_core\base\Plugin;

class PermissionsPlugin extends Plugin
{
    public function init()
    {
        \Yii::$app->behaviors['AccessBehavior']->protect = array_merge(\Yii::$app->behaviors['AccessBehavior']->protect,
            ['permit']);

        if(!\Yii::$app->user->isGuest) {
            $this->addAdminMenuItems();
        }
    }

    public function preSettings()
    {
        \Yii::$app->setModule('permit', [
            'class' => 'developeruz\db_rbac\Yii2DbRbac',
            'layout' => '@vendor/developeruz/yii-kit-core/views/layouts/main',
            'params' => [
                'userClass' => 'app\models\User'
            ]
        ]);
    }

    public static function uninstall()
    {
        return 'Please, read ReadMe.md "Uninstall" section for additional uninstall information';
    }

    public static function info()
    {
        return 'Dynamic control of access rights in Yii2 (c) Developeruz (http://github.com/developeruz/yii2-db-rbac/)';
    }

    private function addAdminMenuItems()
    {
        $this->addLeftMenuItem([
            'label' => 'Permissions',
            'icon' => 'fa fa-user-secret',
            'url' => '#',
            'items' => [
                ['label' => 'Roles', 'icon' => 'fa fa-user-secret', 'url' => ['/permit/access/role'],],
                ['label' => 'Permissions', 'icon' => 'fa fa-unlock-alt', 'url' => ['/permit/access/permission'],],
            ]
        ]);
    }
}
