<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperimentSegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            [
                'name'      => 'test2',
                'email'       => 'test2@test.ru',
                'password'  => '$2y$10$qjSeNmjjUAjaUJVtanJj9uo7flSlRs/vqF3z/OQlnBX1YWPdNwE5S'
            ],
            [
                'name'      => 'test3',
                'email'       => 'test3@test.ru',
                'password'  => '$2y$10$qjSeNmjjUAjaUJVtanJj9uo7flSlRs/vqF3z/OQlnBX1YWPdNwE5S'
            ],
        ]);

        DB::table('projects')->insert([
            [
                'user_id'   => 1,
                'name'      => 'test1',
                'url'       => 'test_url',
                'ym_login'  => 'login',
                'ym_token'  => 'token',
            ],
            [
                'user_id'   => 2,
                'name'      => 'test2',
                'url'       => 'test2_url',
                'ym_login'  => 'login',
                'ym_token'  => 'token',
            ],
        ]);

       /* DB::table('experiments')->insert([
            [
                'project_id'   => 1,
                'name'      => 'test1',
                'url'       => 'test_url',
                'ym_login'  => 'login',
                'ym_token'  => 'token',
            ],
            [
                'project_id'   => 2,
                'name'      => 'test2',
                'url'       => 'test2_url',
                'ym_login'  => 'login',
                'ym_token'  => 'token',
            ],
        ]);*/
    }
}
