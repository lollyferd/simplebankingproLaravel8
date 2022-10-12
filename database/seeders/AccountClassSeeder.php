<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // truncate `states` table
    DB::table('account_classes')->delete();

     $Accountclass = [
        '10' => 'Asset',
        '20' => 'Liability',
        '30' => 'Capital',
        '40' => 'Income',
        '50' => 'Expense',
     ];

     $data =[];

     foreach ($Accountclass as $classid => $name){

        $data[] = [
            'classid' => $classid,
            'classname' => $name,
            'created_at' => Carbon::now(),
            'updated_at' => now()
        ];

     }

     DB::table('account_classes')->insert($data);
    }
}
