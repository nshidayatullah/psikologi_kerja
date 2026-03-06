<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Question;
use App\Models\QuestionCategory;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Ketaksaan Peran' => [1, 7, 13, 19, 25],
            'Konflik Peran' => [2, 8, 14, 20, 26],
            'Beban Berlebih Kuantitatif' => [3, 9, 15, 21, 27],
            'Beban Berlebih Kualitatif' => [4, 10, 16, 22, 28],
            'Pengembangan Karir' => [5, 11, 17, 23, 29],
            'Tanggung Jawab Terhadap Orang Lain' => [6, 12, 18, 24, 30],
        ];

        $questionsText = [
            1 => 'Tujuan tugas-tugas dan pekerjaan saya tidak jelas',
            2 => 'Saya mengerjakan tugas-tugas atau proyek yang tidak perlu',
            3 => 'Saya harus membawa pulang pekerjaan saya rutin setiap sore hari atau akhir pekan demi mengejar waktu',
            4 => 'Tuntutan-tuntutan mengenai mutu pekerjaan terhadap saya keterlaluan',
            5 => 'Saya tidak mempunyai kesempatan yang memadai untuk maju dalam organisasi ini',
            6 => 'Saya bertanggung jawab untuk pengembangan karyawan lain',
            7 => 'Saya tidak jelas kepada siapa harus melapor dan/atau siapa yang melapor kepada saya',
            8 => 'Saya terjepit di tengah-tengah antara atasan dan bawahan',
            9 => 'Saya diberikan terlalu banyak pekerjaan dari yang bisa saya tangani',
            10 => 'Dalam pekerjaan saya, saya diharapkan agar mampu melakukan hal teknis tanpa diberikan pelatihan atau sumber daya yang memadai',
            11 => 'Saya tidak menerima umpan balik/feedback berkala mengenai kualitas kerja saya',
            12 => 'Saya merasa beban masalah orang lain di tempat kerja menjadi beban saya sendiri',
            13 => 'Saya tidak mengerti bagian yang diperankan rekan kerja saya terhadap pencapaian keseluruhan kelompok saya',
            14 => 'Saya sering menerima tugas dari orang yang berbeda tanpa urutan prioritas yang jelas',
            15 => 'Pekerjaan saya mengharuskan bekerja dengan kecepatan/ritme yang sangat tinggi',
            16 => 'Tugas-tugas tampaknya makin hari menjadi makin kompleks',
            17 => 'Saya merugikan kemajuan karir saya dengan tetap berada dalam organisasi ini',
            18 => 'Saya bertindak atau membuat keputusan-keputusan yang mempengaruhi keselamatan dan kesejahteraan orang lain',
            19 => 'Saya tidak mengerti sepenuhnya apa yang diharapkan dari saya',
            20 => 'Saya melakukan pekerjaan yang diterima oleh satu orang tapi tidak diterima oleh orang lain',
            21 => 'Saya benar-benar mempunyai pekerjaan yang lebih banyak daripada yang biasanya dapat dikerjakan dalam sehari',
            22 => 'Organisasi mengharapkan saya melebihi keterampilan dan/atau kemampuan yang saya miliki',
            23 => 'Saya hanya mempunyai sedikit kesempatan untuk berkembang dan belajar pengetahuan dan keterampilan baru dalam pekerjaan saya',
            24 => 'Tanggung jawab saya dalam organisasi ini lebih mengenai orang daripada barang',
            25 => 'Saya tidak mengerti bagian yang diperankan pekerjaan saya dalam memenuhi tujuan organisasi keseluruhan',
            26 => 'Saya menerima permintaan-permintaan yang saling bertentangan dari satu orang atau lebih',
            27 => 'Saya merasa bahwa saya betul-betul tidak punya waktu untuk istirahat berkala',
            28 => 'Saya kurang terlatih dan/atau kurang berpengalaman untuk melaksanakan tugas-tugas saya secara memadai',
            29 => 'Saya merasa karir saya tidak berkembang',
            30 => 'Saya bertanggung jawab atas hari depan (karir) orang lain',
        ];

        foreach ($categories as $categoryName => $questionNumbers) {
            $category = QuestionCategory::create(['name' => $categoryName]);

            foreach ($questionNumbers as $number) {
                if (isset($questionsText[$number])) {
                    Question::create([
                        'question_category_id' => $category->id,
                        'number' => $number,
                        'body' => $questionsText[$number],
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
