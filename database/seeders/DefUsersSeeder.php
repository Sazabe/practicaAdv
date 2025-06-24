<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use App\Models\Building;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\FrontUser;
use App\Models\Manager;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DefUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = Country::where('iso2', 'ES')->first(); // Defininr un pais, por ejemplo España
        
        $state = State::where('country_id', $country?->id)
            ->where('name', 'Madrid')
            ->first();

        $city = City::where('country_id', $country?->id)
            ->where('state_id', $state?->id)
            ->where('name', 'Madrid')
            ->first();

        //default laravel user, por probar cosas si me fallan los mios
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);

        $admin = AdminUser::create([
            'name' => 'admXp',
            'public_name' => 'admXp',
            'email' => 'admin@xpanse.com',
            'password' => Hash::make('1234'),
            'country_id' => $country?->id,
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);

        $manager = Manager::create([
            'name' => 'xpansem',
            'public_name' => 'mngXp',
            'email' => 'manager@xpanse.com',
            'admin_user_id' => $admin->id,
            'country_id' => $country?->id,
            'password' => Hash::make('1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);

        $company = Company::create([
            'name' => 'Xpanse Technologies',
            'cif' => 'X12345678',
            'email' => 'info@xpanse.com',
            'phone' => '+34 600 000 000',
            'address' => 'Calle Tecnología 42',
            'postalcode' => '22312',
            'country_id' => $country?->id,
            'state_id' => $state?->id,
            'city_id' => $city?->id,
        ]); // Relacionar manager con company
        $manager->companies()->attach($company->id);

        $building = Building::create([
            'name' => 'Edificio Central',
            'public_name' => 'Prica',
            'address' => 'Av. Llano 10',
            'postalcode' => '22312',
            'country_id' => $country?->id,
            'state_id' => $state?->id,
            'city_id' => $city?->id,
        ]); // Relacionar company con building
        $company->buildings()->attach($building->id);
        
        FrontUser::create([
            'email' => 'front@xpanse.com',
            'password' => Hash::make('1234'),
            'name' => 'fntXp',
            'public_name' => 'Usuario Final',
            'company_id' => $company->id,
            'country_id' => $country?->id,
            'state_id' => $state?->id,
            'city_id' => $city?->id,
            'address' => 'Calle Usuario Final 33',
            'postcode' => '28002',
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
    ]);
    }
}
