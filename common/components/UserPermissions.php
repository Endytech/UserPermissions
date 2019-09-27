<?php

namespace common\components;

use common\models\Procurement;

class UserPermissions
{

    public $currentUser;

// public $rule = [User::ROLE_ADMIN => [
//     'view' => [
//     Procurement::STATUS_PLANNED_FOR_EXECUTION => true,
//     Procurement::STATUS_BIDDING => true,
//     Procurement::STATUS_DECISION_MAKING => true,
//     Procurement::STATUS_IN_PROGRESS => true,
//     Procurement::STATUS_PROCUREMENT_COMPLETED => true,
//     Procurement::STATUS_CANCELLED => true,
//     Procurement::STATUS_ARCHIVED => true,
//     Procurement::STATUS_DELETED => true,
//     ],
//     'edit' => [
//     Procurement::STATUS_PLANNED_FOR_EXECUTION => true,
//     Procurement::STATUS_BIDDING => true,
//     Procurement::STATUS_DECISION_MAKING => true,
//     Procurement::STATUS_IN_PROGRESS => true,
//     Procurement::STATUS_PROCUREMENT_COMPLETED => true,
//     Procurement::STATUS_CANCELLED => true,
//     Procurement::STATUS_ARCHIVED => true,
//     Procurement::STATUS_DELETED => true,
//     ],
//     ],
//     User::ROLE_ACQUISITION_MANAGER => [
//         'view' => [
//             Procurement::STATUS_PLANNED_FOR_EXECUTION => true,
//             Procurement::STATUS_BIDDING => true,
//             Procurement::STATUS_DECISION_MAKING => true,
//             Procurement::STATUS_IN_PROGRESS => true,
//             Procurement::STATUS_PROCUREMENT_COMPLETED => true,
//             Procurement::STATUS_CANCELLED => true,
//             Procurement::STATUS_ARCHIVED => true,
//             Procurement::STATUS_DELETED => false,
//         ],
//     ]
// ];

    public function getUser()
    {
        $this->currentUser = \Yii::$app->user->identity;
    }

    public function canViewProcurement($procurement)
    {
        $this->getUser();

        $currentUserID = $this->currentUser->id;

        if (\Yii::$app->user->isGuest) {
            return false;
        }

        if ($this->currentUser->isAdmin()) {
            return true;
        }

        if ($this->currentUser->isSupervisor()) {
            return true;
        }

        if ($this->currentUser->isManager()) {
            if ($procurement) {
                if ($procurement->procurement_status == Procurement::STATUS_DELETED) {
                    return false;
                }
                if ($procurement->procurement_owner == $currentUserID) {
                    return true;
                }
            } else {
                return false;
            }
        }

        if ($this->currentUser->isSupplier()) {
            if ($procurement) {
                switch ($procurement->Procurement_status) {
                    case Procurement::STATUS_PLANNED_FOR_EXECUTION:
                        return false;
                    case Procurement::STATUS_BIDDING:
                        return true;
                    case Procurement::STATUS_DECISION_MAKING:
                        if ($this->currentUser->hasTenderBids($procurement)) {
                            return true;
                        }
                        break;
                    case Procurement::STATUS_IN_PROGRESS:
                        if ($this->currentUser->isWinnerTender($procurement)) {
                            return true;
                        }
                        break;
                    case Procurement::STATUS_PROCUREMENT_COMPLETED:
                        if ($this->currentUser->isWinnerTender($procurement)) {
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

    public function canUsersViewProcurement($user, $procurement)
    {
        $this->currentUser = $user;

        if ($this->currentUser->isAdmin()) {
            return true;
        }

        return false;
    }
}
