<?php
namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    protected $model = Produk::class;
    public function definition(){
        return [
            'name' => $this->faker->name,
            'user_id' => 1,
        ];
    }
}
