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
                if ($procurement->procurement_status == Procurement::STATUS_PLANNED_FOR_EXECUTION || $procurement->procurement_status == Procurement::STATUS_CANCELLED ||
                    $procurement->procurement_status == Procurement::STATUS_ARCHIVED || $procurement->procurement_status == Procurement::STATUS_DELETED){
                    return false;
                }
                if ($procurement->procurement_status == Procurement::STATUS_BIDDING ||
                    ($procurement->procurement_status == Procurement::STATUS_DECISION_MAKING && $currentUser->hasTenderBids($procurement)) ||
                    (($procurement->procurement_status == Procurement::STATUS_IN_PROGRESS || $procurement->procurement_status == Procurement::STATUS_COMPLETED) && $currentUser->isWinnerTender($procurement))){
                    return true;
                }
            } else {
                return false;
            }
        }

        return false;
    }

}
