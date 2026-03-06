<?php

namespace Database\Seeders;

use App\Models\Signer;
use Illuminate\Database\Seeder;

class SignerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $signers = [
            [
                'type' => 'pic1',
                'label' => 'PIC 1',
                'name' => 'M. Hidayatullah',
                'role' => 'Safety Officer',
            ],
            [
                'type' => 'pic2',
                'label' => 'PIC 2',
                'name' => 'Junardi',
                'role' => 'HR Manager',
            ],
            [
                'type' => 'reviewer',
                'label' => 'Dokter Pemeriksa',
                'name' => 'dr. Haamim Sajdah S',
                'role' => 'Corporate Doctor',
            ],
        ];

        foreach ($signers as $signer) {
            Signer::updateOrCreate(['type' => $signer['type']], $signer);
        }
    }
}
