<?php

use App\Item\Item;
use App\Item\Category;
use Illuminate\Database\Seeder;

class ItemsAndCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create(['name' => 'Elektronik'])->id;
        $category2 = Category::create(['name' => 'Fashion'])->id;
        $category3 = Category::create(['name' => 'Otomotif'])->id;
        $category4 = Category::create(['name' => 'Peralatan Rumah Tangga'])->id;
        $category5 = Category::create(['name' => 'Kesehatan'])->id;

        $item = factory(Item::class)->create([
            'store_id' => 1,
            'name' => 'Lorem Ipsum',
        ]);

        $item->categories()->attach([$category1, $category5]);
    }
}
