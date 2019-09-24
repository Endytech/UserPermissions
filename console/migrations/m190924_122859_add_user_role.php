<?php

use yii\db\Migration;

/**
 * Class m190924_122859_add_user_role
 */
class m190924_122859_add_user_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role_id', 'INTEGER(3)');
        $this->execute("
                INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `role_id`) VALUES
	(1, 'admin', '-_zru7IJ8cP9eqpJPaXiInnVsABTeJtP', '$2y$13$353TlSEN8ItpseGUrwJMIu/z6.IyDyDvtpqS..ZXSqBoixpNxmWQu', NULL, 'admin@cybtronix.com', 10, 1569323958, 1569323958, '', '1');
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'role_id');
        $this->delete('user', 'email = \'admin@cybtronix.com\'');
    }

}
