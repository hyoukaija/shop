<?php

use think\migration\Seeder;

class AdminUser extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $adminUser = new \app\backend\model\AdminUser();
        $adminUser->username = 'admin';
        $adminUser->password = password_hash('19910810',PASSWORD_BCRYPT);
        $adminUser->save();
    }
}