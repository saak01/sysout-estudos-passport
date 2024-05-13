<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user-> name = 'Victor';
        $user->group_id = 1;
        $user-> email = 'victor@sysout.com';
        $user-> password = bcrypt('sysout');
        $user-> save();

        $user2 = new User();
        $user2-> name = 'Fred';
        $user2->group_id = 2;
        $user2-> email = 'fred@sysout.com';
        $user2-> password = bcrypt('sysout');
        $user2-> save();

        $user3 = new User();
        $user3-> name = 'Vinicius';
        $user3->group_id = 2;
        $user3-> email = 'vin@sysout.com';
        $user3-> password = bcrypt('sysout');
        $user3-> save();
    }
}
