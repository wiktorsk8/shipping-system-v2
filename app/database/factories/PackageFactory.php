<?php

namespace Database\Factories;


use App\Helpers\Package\PackageIdGenerator;
use App\Helpers\Package\PackageStatus;
use App\Helpers\User\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\Enums\UserRole;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->realText(mt_rand(10, 16));        // fake package name
        $clients = new UserInfo(UserRole::Client->value);    // get all users     
        $everyUserId = $clients->GetIdList();                   // get id list of all users    
        $id = $this->faker->randomElement($everyUserId);        // get random id

        unset($everyUserId[array_search($id, $everyUserId)]);   // delete choosen id from list to prevent the situation when senders_id == receivers_id    

        return [
            'name' => $name,
            'senders_address' => $this->faker->address(),                               
            'receivers_address' => $this->faker->address(),
            'size'=> $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
            'cash_on_delivery'=> $this->faker->boolean(50),
            'senders_id' => $id,
            'receivers_id' => $this->faker->randomElement($everyUserId),
            'package_number' => PackageIdGenerator::generate($id, $name),
            'status' => $this->faker->randomElement(PackageStatus::PACKAGE_STATUS),

        ];
    }
}
