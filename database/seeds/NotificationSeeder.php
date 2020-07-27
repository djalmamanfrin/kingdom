<?php

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        factory(Notification::class, 10)->create();
    }
}
