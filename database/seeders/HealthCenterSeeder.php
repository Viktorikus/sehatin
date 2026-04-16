<?php

namespace Database\Seeders;

use App\Models\HealthCenter;
use App\Models\HealthService;
use Illuminate\Database\Seeder;

class HealthCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centers = [
            [
                'name' => 'Puskesmas Pusat Kota',
                'address' => 'Jl. Merdeka No. 123',
                'phone' => '(021) 123-4567',
                'email' => 'puskesmas.pusat@kota.id',
                'city' => 'Jakarta',
                'district' => 'Jakarta Pusat',
                'latitude' => -6.1751,
                'longitude' => 106.8249,
                'description' => 'Puskesmas dengan fasilitas lengkap dan dokter spesialis',
                'operating_hours' => 'Senin - Jumat: 08:00 - 16:00, Sabtu: 08:00 - 12:00',
                'is_active' => true,
            ],
            [
                'name' => 'Puskesmas Barat',
                'address' => 'Jl. Ahmad Yani No. 45',
                'phone' => '(021) 456-7890',
                'email' => 'puskesmas.barat@kota.id',
                'city' => 'Jakarta',
                'district' => 'Jakarta Barat',
                'latitude' => -6.1750,
                'longitude' => 106.7500,
                'description' => 'Puskesmas melayani wilayah Jakarta Barat',
                'operating_hours' => 'Setiap hari: 08:00 - 17:00',
                'is_active' => true,
            ],
            [
                'name' => 'Puskesmas Timur',
                'address' => 'Jl. Gatot Subroto No. 78',
                'phone' => '(021) 789-0123',
                'email' => 'puskesmas.timur@kota.id',
                'city' => 'Jakarta',
                'district' => 'Jakarta Timur',
                'latitude' => -6.2250,
                'longitude' => 106.8800,
                'description' => 'Puskesmas dengan layanan vaksinasi dan imunisasi',
                'operating_hours' => 'Senin - Sabtu: 08:00 - 16:00',
                'is_active' => true,
            ],
        ];

        foreach ($centers as $center) {
            $hc = HealthCenter::create($center);

            // Add services for each center
            $services = [
                [
                    'name' => 'Konsultasi Dokter Umum',
                    'description' => 'Pemeriksaan kesehatan umum dan diagnosis',
                    'price' => 100000,
                    'estimated_duration' => 30,
                    'quota_per_day' => 30,
                ],
                [
                    'name' => 'Pemeriksaan Tekanan Darah',
                    'description' => 'Cek tekanan darah dan kesehatan jantung',
                    'price' => 50000,
                    'estimated_duration' => 15,
                    'quota_per_day' => 50,
                ],
                [
                    'name' => 'Imunisasi',
                    'description' => 'Vaksinasi dan imunisasi sesuai jadwal',
                    'price' => 150000,
                    'estimated_duration' => 45,
                    'quota_per_day' => 20,
                ],
                [
                    'name' => 'Tes Laboratorium',
                    'description' => 'Pengambilan sampel darah dan tes laboratorium',
                    'price' => 200000,
                    'estimated_duration' => 20,
                    'quota_per_day' => 25,
                ],
                [
                    'name' => 'Perawatan Luka',
                    'description' => 'Perawatan dan penggantian perban',
                    'price' => 75000,
                    'estimated_duration' => 30,
                    'quota_per_day' => 15,
                ],
            ];

            foreach ($services as $service) {
                HealthService::create([
                    'health_center_id' => $hc->id,
                    ...$service,
                ]);
            }
        }
    }
}
