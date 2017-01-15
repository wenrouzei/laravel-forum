<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //执行执行factory生成测试数据
        factory('App\Models\User', 50)->create();
        factory('App\Models\Discussion', 30)->create();
        factory('App\Models\Comment', 100)->create();

        //构造器生成数据
        DB::table('users')->insert([
            ['name' => 'test',
                'email' => 'test@qq.com',
                'password' => bcrypt('123456'),
                'confirm_token' => str_random(60),
                'is_confirmed' => 1,
                'avatar'=>'/images/avatars/default.png',
                'remember_token' => str_random(60),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]
        ]);
    }
}
