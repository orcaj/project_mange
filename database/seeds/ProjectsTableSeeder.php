<?php

use Illuminate\Database\Seeder;
use App\Project;


class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::truncate();
        
        DB::table('projects')->insert([
            'id' => 1,
            'project_name' =>'Landscaping and External Works at the Newly reconstructed police lodge at the Government House Awka',
            'contractor' =>'HEMEBS CONS/MTCE SERVICES',
            'mda_id' =>1,
            'senatorial_zone' =>'Anambra Central',
            'lga_location' => 'Awka South/Awka',
            'contract_amount' =>10000000.00,
            'amount_disbursed' =>500000,
            'balance_payment' =>9500000.00,
            'current_ipc_no' =>'1',
            'current_ipc_amount' =>2000000.00,
            'project_per_completion' =>60,
            'start_date' =>'2019-01-15',
            'expected_date' =>'2020-01-20',
        ]);

        DB::table('projects')->insert([
            'id' => 2,
            'project_name' =>'Landscaping and External Works at the Newly reconstructed police lodge at the Government House Awka',
            'contractor' =>'HEMEBS CONS/MTCE SERVICES',
            'mda_id' =>2,
            'senatorial_zone' =>'Anambra Central',
            'lga_location' => 'Awka South/Awka',
            'contract_amount' =>10000000.00,
            'amount_disbursed' =>500000,
            'balance_payment' =>9500000.00,
            'current_ipc_no' =>'1',
            'current_ipc_amount' =>2000000.00,
            'project_per_completion' =>60,
            'start_date' =>'2019-11-25',
            'expected_date' =>'2020-10-20',
        ]);
    }
}
