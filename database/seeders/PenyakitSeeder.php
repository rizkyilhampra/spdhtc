<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penyakit;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            [
                'name' => 'Virus Kuning (Gemini Virus)',
                'reason' => 'Virus Gemini; ditularkan oleh kutu putih/kutu kebul Bemisia tabaci.',
                'solution' => implode("\n", [
                    '1. Penggunaan mulsa perak di dataran tinggi, dan jerami di dataran rendah mengurangi infestasi serangga pengisap daun.',
                    '2. Eradikasi tanaman sakit; tanaman bergejala segera dicabut dan dimusnahkan.',
                    '3. Menanam varietas agak tahan (mis. cabai keriting Bukittinggi).',
                    '4. Rotasi tanaman dengan bukan inang dan sanitasi lingkungan.',
                    '5. Gejala ringan: aplikasikan PGPR atau pupuk hayati.',
                    '6. Pemupukan berimbang: 150–200 kg Urea, 450–500 kg ZA, 100–150 kg TSP, 100–150 kg KCl, 20–30 ton pupuk organik/ha.',
                    '7. Fokus pengendalian pestisida pada serangga vektor.',
                ]),
                'image' => '583706090.jpg',
            ],
        ];

        foreach ($rows as $row) {
            Penyakit::updateOrCreate(
                ['name' => $row['name']],
                [
                    'reason'  => $row['reason'],
                    'solution'=> $row['solution'],
                    'image'   => $row['image'],
                ]
            );
        }
    }
}
