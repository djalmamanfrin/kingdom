<?php

use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    public function run()
    {
        factory(Wishlist::class, 30)->create();
    }
}
