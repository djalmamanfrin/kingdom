<?php

use App\Models\NotificationType;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    public function run()
    {
        factory(NotificationType::class, 10)->create();
    }
}
