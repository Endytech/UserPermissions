Это advanced yii2, как обычно init, composer, common/config - DB и migrate

Добавляем миграцией role_id в таблицу user
```php
$this->addColumn('user', 'role_id', 'INTEGER(3)');
```
Дополнительно миграцией создаю админа admin@cybtronix.com с паролем из ТЗ п.1.3

Добавляем роли и определяющие роль методы в модель user
```php
namespace common\models;
...
class User extends ActiveRecord implements IdentityInterface
{
...
   const ROLE_ADMIN = 1;
   const ROLE_SUPERVISOR = 2;
   const ROLE_ACQUISITION_MANAGER = 3;
   const ROLE_SUPPLIER = 4;

   public function isAdmin()
   {
       return $this->role_id == self::ROLE_ADMIN;
   }
   public function isSupervisor()
   {
       return $this->role_id == self::ROLE_SUPERVISOR;
   }
   public function isManager()
   {
       return $this->role_id == self::ROLE_ACQUISITION_MANAGER;
   }
   public function isSupplier()
   {
       return $this->role_id == self::ROLE_SUPPLIER;
   }
…
```

Добавляем класс UserPermissions, чтобы сделать его компонентом приложения где user берется как \Yii::$app->user->identity, а остальные данные, если требуется, передаются в функцию при ее вызове.
common\components\UserPermissions.php

```php
<?php
namespace common\components;

class UserPermissions
{
   public function canViewProcurement($procurement)
   {
       $currentUserID = \Yii::$app->user->getId();
       $currentUser = \Yii::$app->user->identity;

       if (\Yii::$app->user->isGuest) {
           return false;
       }

       if ($currentUser->isAdmin()) {
           return true;
       }

       if ($currentUser->isSupervisor()) {
           return true;
       }

       if ($currentUser->isManager()) {
           if ($procurement) {
               if ($procurement->procurement_status == Procurement::STATUS_DELETED){
                   return false;
               }
               if ($procurement->procurement_owner == $currentUserID) {
                   return true;
               }
           } else {
               return false;
           }
       }

  if ($currentUser->isSupplier()) {
            if ($procurement) {
                switch ($procurement->procurement_status){
                    case Procurement::STATUS_PLANNED_FOR_EXECUTION:
                        return false;
                    case Procurement::STATUS_BIDDING:
                        return true;
                    case Procurement::STATUS_DECISION_MAKING:
                        if ($currentUser->hasTenderBids($procurement)){
                            return true;
                        }
                        break;
                    case Procurement::STATUS_IN_PROGRESS:
                        if ($currentUser->isWinnerTender($procurement)){
                            return true;
                        }
                        break;
                    case Procurement::STATUS_PROCUREMENT_COMPLETED:
                        if ($currentUser->isWinnerTender($procurement)){
                            return true;
                        }
                        break;
                    case Procurement::STATUS_CANCELLED:
                        return false;
                    case Procurement::STATUS_ARCHIVED:
                        return false;
                    case Procurement::STATUS_DELETED:
                        return false;
                }
            } else {
                return false;
            }
        }
       return false;
   }

}
```

Добавляем компонент UserPermissions в приложение 
common\config\main.php
```php
'components' => [
   'cache' => [
       'class' => 'yii\caching\FileCache',
   ],
   'UserPermissions' => [
       'class' => 'common\components\UserPermissions',
   ],
],
```
Теперь вызывая UserPermissions в любом месте можно выполнить проверку 

```php
if (\Yii::$app->UserPermissions->canViewProcurement([])) {
   echo 'Can View';
}
```
