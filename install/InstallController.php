<?php
namespace app\install;

use app\models\User;
use Yii;

class InstallController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (!$this->checkDbConnection()) {
            $configFile = str_replace(Yii::getAlias('@webroot'), '', Yii::getAlias('@app')) . '/config/db.php';
            return $this->showError(Yii::t('app', 'Cannot connect to database. Please configure `{0}`.', $configFile));
        }

        $installForm = new InstallForm();

        if ($installForm->load(Yii::$app->request->post()) && $installForm->validate()) {
            $log = $this->migrate($installForm);
            return $this->render('@app/install/finish', compact('log'));
        } else {
            $this->layout = '@vendor/developeruz/yii-kit-core/views/layouts/main-login';
            return $this->render('@app/install/form', compact('installForm'));
        }
    }

    private function checkDbConnection()
    {
        try {
            Yii::$app->db->open();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function showError($text)
    {
        return $this->render('/site/error', ['message' => $text]);
    }

    private function migrate($installForm)
    {
        $webApp = Yii::$app;
        ob_start();
        $consoleConfig = require(Yii::getAlias('@app/config/console.php'));
        $console = new \yii\console\Application($consoleConfig);
        $console->runAction('migrate',
            ['migrationPath' => '@yii/rbac/migrations/', 'interactive' => false]);
        $console->runAction('migrate',
            ['migrationPath' => '@vendor/developeruz/yii-kit-core/migrations/', 'interactive' => false]);

        $console->runAction('migrate',
            ['migrationPath' => '@vendor/dektrium/yii2-user/migrations', 'interactive' => false]);
        $console->runAction('user/create', [$installForm->root_email, $installForm->root_login, $installForm->root_password]);
        $console->runAction('user/confirm', [$installForm->root_email]);

        $user = User::find()->where(['email' => $installForm->root_email])->one();
        $role = Yii::$app->authManager->createRole('admin');
        $role->description = Yii::t('app', 'Admin');
        Yii::$app->authManager->add($role);
        Yii::$app->authManager->assign($role, $user->getId());

        $permission = Yii::$app->authManager->createPermission('permit');
        Yii::$app->authManager->add($permission);
        Yii::$app->authManager->addChild($role, $permission);

        $permission = Yii::$app->authManager->createPermission('user');
        Yii::$app->authManager->add($permission);
        Yii::$app->authManager->addChild($role, $permission);

        $result = ob_get_contents();
        ob_end_clean();
        Yii::$app = $webApp;
        return str_replace("\n", '<br>', $result);
    }
}
