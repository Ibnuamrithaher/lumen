<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\User;
use Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $this->call('UsersTableSeeder');
        // Disable foreign key checking because truncate() will fail
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Produk::truncate();

        User::factory(20)->create();
        Produk::factory(1)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
