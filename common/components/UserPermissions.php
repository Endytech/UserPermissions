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
