<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'name' => 'Ремонт двигателей'
            ],
            [
                'name' => 'Установка стекол'
            ],
            [
                'name' => 'Сантехники'
            ],
            [
                'name' => 'Мебель на заказ'
            ],
        ];
        foreach($services as $index => $service)
        Service::firstOrCreate($service);
    }
}
