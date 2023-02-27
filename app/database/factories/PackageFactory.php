<?php

namespace Database\Factories;


use App\Models\Package;
use App\Helpers\Enums\PackageStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\Enums\UserRole;
use App\Repositories\ClientRepository;

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
        $name = $this->faker->realText(mt_rand(10, 16));                        // fake package name
        $id_list = ClientRepository::getIdList();                                                                 
        $id = $this->faker->randomElement($id_list);                        // get random id

        unset($id_list[array_search($id, $id_list)]);                   // delete choosen id from list to prevent the situation when senders_id == receivers_id    

        return [
            'name' => $name,
            'senders_address' => $this->faker->address(),                               
            'receivers_address' => $this->faker->address(),
            'size'=> $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
            'cash_on_delivery'=> $this->faker->boolean(50),
            'senders_id' => $id,
            'receivers_id' => $this->faker->randomElement($id_list),
            'package_number' => Package::generate($id, $name),
            'status' => $this->faker->randomElement(PackageStatus::toArray()),

        ];
    }
}
