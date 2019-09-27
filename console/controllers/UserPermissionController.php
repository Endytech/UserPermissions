<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;

class UserPermissionController extends Controller
{
    public function actionTest()
    {
        $users = User::find()->all();
        foreach ($users as $user) {

            \Yii::$app->user->setIdentity($user);

            print_r(\Yii::$app->user->identity->isAdmin());

            if (\Yii::$app->UserPermissions->canViewProcurement([])) {
                echo 'User '. $user->email . ' Can View Procurement';
            }
//            if (\Yii::$app->UserPermissions->canUsersViewProcurement($user, [])) {
//                echo 'User '. $user->email . ' Can View Procurement';
//            }
        }
    }
}