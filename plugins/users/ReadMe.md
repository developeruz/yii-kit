### Uninstall
- remove user module from `config/modules.php`
```php
 'user' => [
 ...
 ]
 ```
- remove user module from `config/console.php`
 ```php
  'user' => [
             'class' => 'dektrium\user\Module',
  ],
 ```
- change User model `models/User.php` if it is extends `dektrium\user\models\User`
