<?php

namespace Database\Seeders;

use App\Models\TickerDatum;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TickerDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $currentDay = Carbon::now();
        $startFromDay = $currentDay->copy()->subYears(3);
        $data = [];

        $i = 1;
        while ($startFromDay->lessThan($currentDay)) {
            $this->command->info('Iteration '.$i.'...'.' Date: '.$startFromDay);

            $price = $faker->randomFloat(2, 7000, 60000);
            $data[] = [
                'bid' => $price,
                'ask' => $price,
                'last_price' => $price,
                'from_currency' => 'btc',
                'to_currency' => 'usd',
                'valid_at' => $startFromDay->toDateTimeString(),
                'inserted_at' => $startFromDay->toDateTimeString(),
            ];

            $diffInYears = $startFromDay->diffInYears($currentDay);
            $diffInMonths = $startFromDay->diffInMonths($currentDay);
            $diffInDays = $startFromDay->diffInDays($currentDay);

            if ($diffInYears > 1) {
                $startFromDay->addWeek();
            } elseif ($diffInYears == 1) {
                $startFromDay->addDay();
            } elseif ($diffInYears == 0) {
                if ($diffInMonths > 3) {
                    $startFromDay->addWeek();
                } elseif ($diffInMonths > 1) {
                    $startFromDay->addHours(12);
                } elseif ($diffInMonths == 1) {
                    $startFromDay->addHours(6);
                } else {
                    if ($diffInDays > 7) {
                        $startFromDay->addHours(6);
                    } elseif ($diffInDays > 3) {
                        $startFromDay->addHour();
                    } elseif ($diffInDays > 1) {
                        $startFromDay->addMinutes(30);
                    } elseif ($diffInDays == 1) {
                        $startFromDay->addMinutes(15);
                    } else {
                        $startFromDay->addMinute();
                    }
                }
            }
            $i++;
        }

        foreach (array_chunk($data, 1000) as $index => $chunkArray) {
            $this->command->info('Inserting chunk: '.$index.'...');
            TickerDatum::query()->insert($chunkArray);
        }
    }
}
