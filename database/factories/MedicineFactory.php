<?php  

namespace Database\Factories;  

use Illuminate\Database\Eloquent\Factories\Factory;  
use App\Models\Medicine;  

/**  
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>  
 */  
class MedicineFactory extends Factory  
{  
    protected $model = Medicine::class;  

    /**  
     * Define the model's default state.  
     *  
     * @return array<string, mixed>  
     */  
    public function definition(): array  
    {  
        return [  
            'scientific_name' => $this->faker->word . ' ' . $this->faker->word,  
            'trade_name' => $this->faker->word,  
            'classification' => $this->faker->word,  
            'manufacturer' => $this->faker->company,  
            'quantity_available' => $this->faker->numberBetween(1, 1000),  
            'expiration_date' => $this->faker->dateTimeBetween('+1 week', '+3 years')->format('Y-m-d'),  
            'price' => $this->faker->randomFloat(2, 1, 100), // Random price between 1.00 and 100.00  
        ];  
    }  
}