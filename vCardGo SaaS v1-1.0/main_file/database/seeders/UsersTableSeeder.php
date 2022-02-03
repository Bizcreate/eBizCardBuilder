<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Utility;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => \Hash::make('1234'),
                'type' => 'super admin',
                'lang' => 'en',
            ]
        );
        $company = User::create(
            [
                'name' => 'Company',
                'email' => 'company@example.com',
                'password' => \Hash::make('1234'),
                'type' => 'company',
                'lang' => 'en',
                'created_by' => $superadmin->id,
            ]
        );

        Utility::AddBusinessField();
        Utility::add_landing_page_data();
    }
}
