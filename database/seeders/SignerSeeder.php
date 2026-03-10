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
                'role' => 'Paremedic',
            ],
            [
                'type' => 'pic2',
                'label' => 'PIC 2',
                'name' => 'Zulkifli',
                'role' => 'Paramedic',
            ],
            [
                'type' => 'reviewer',
                'label' => 'Dokter Perusahaan',
                'name' => 'dr. Haamim Sajdah Sya\'ban',
                'role' => 'Dokter Perusahaan',
            ],
        ];

        foreach ($signers as $signer) {
            Signer::updateOrCreate(['type' => $signer['type']], $signer);
        }
    }
}
