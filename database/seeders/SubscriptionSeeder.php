<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::query()->forceDelete();

        // 1 
            $subscription= Subscription::create([
                'id' => '1',
                'month_number' => 4,
                'price' => 500,

            ]);
            $subscription->subscription_languages()->create( [
                'name' => ' مجانى',
                'language' => 'ar',
            ]);
            $subscription->subscription_languages()->create( [
                'name' => 'free',
                'language' => 'en',
            ]);            
        // 2
            $subscription= Subscription::create([
                'id' => '2',
                'month_number' => 6,
                'price' => 1000,

            ]);
            $subscription->subscription_languages()->create( [
                'name' => 'شهري',
                'language' => 'ar',
            ]);
            $subscription->subscription_languages()->create( [
                'name' => 'monthly',
                'language' => 'en',
            ]);
        // 3
            $subscription= Subscription::create([
                'id' => '3',
                'month_number' => 7,
                'price' => 2000,

            ]);
            $subscription->subscription_languages()->create( [
                'name' => ' سنوي',
                'language' => 'ar',
            ]);
            $subscription->subscription_languages()->create( [
                'name' => 'yearly',
                'language' => 'en',
            ]);
    }

}
