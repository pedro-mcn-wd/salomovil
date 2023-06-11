<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Models\MediaRepository;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stock = rand(0, 200);
        $price = fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000);

        $category_id = Category::inRandomOrder()->distinct()->pluck('id')->first();

        $subcategory_id = Subcategory::where('category_id', $category_id)->inRandomOrder()->distinct()->pluck('id')->first();

        $product = Product::create([
            'name' => fake()->unique()->word,
            'description' => fake()->paragraph($nbSentences = 1, $variableNbSentences = true),
            'stock' => $stock,
            'price' => $price,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
        ]);

        // $imagePath = fake()->image(); // Genera una URL de imagen fake
        // $product->addMediaFromUrl($imagePath)->toMediaCollection('prod_imgs');

        $imagePath = fake()->image(storage_path('app/public/prod_imgs'), 400, 300, null, false);
        $product->addMedia(storage_path('app/public/prod_imgs/' . $imagePath))
                ->preservingOriginal()
                ->toMediaCollection('prod_imgs');

        // Eliminamos la imagen temporal generada por faker
        Storage::disk('public')->delete('prod_imgs/' . $imagePath);

        return $product->toArray();
    }
}
