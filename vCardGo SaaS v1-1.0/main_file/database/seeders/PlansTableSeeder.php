<?php
namespace Database\Seeders;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create(
            [
                'name' => 'Free Plan',
                'price' => 0,
                'duration' => 'Unlimited',
                'themes' => 'theme1,theme2,theme3,theme4,theme5,theme6,theme7,theme8,theme9,theme10',
                'business'=>'-1',
            ]
        );
    }
}
