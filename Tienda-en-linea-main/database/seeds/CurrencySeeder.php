<?php

use Illuminate\Database\Seeder;
use App\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            'mxn',
            'usd'
        ];

        foreach ($currencies as $key => $currency){
            Currency::create([
                'iso'=> $currency,
            ]);
        }
    }
}
