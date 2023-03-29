<?php

namespace Database\Seeders;

use App\Models\Penyakit as ModelsPenyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Penyakit extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //name
        //reason
        //solution
        //image

        ModelsPenyakit::create([
            'name' => 'Layu Fusarium',
            'reason' => 'Fusarium Oxysporum',
            'solution' => 'Pencegahan dan pengendaliannya dilakukan dengan cara yaitu tanah-tanah yang terkontaminasi penyakit layu jangan digunakan. Infeksi penyakit layu dapat dipelajari pada tanaman sebelumnya dan dilakukannya pembersihan lahan dari sisa-sisa tanaman dan gulma.',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Layu Bakteri',
            'reason' => 'Ralstonia Solanacearum ',
            'solution' => 'Cara pengendaliannya adalah semaian yang terinfeksi penyakit harus dicabut dan dimusnahkan, media tanah yang terkontaminasi dibuang dan naungan persemaian secara bertahap dibuka agar matahari masuk dan tanaman menjadi lebih kuat.',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Busuk Buah Antraknosa',
            'reason' => 'Colletotrichum Spp.',
            'solution' => 'Cara pengendaliannya adalah dengan cara buah cabai yang terserang antraknos dikumpulkan dalam kantung plastik tertutup dan dimusnahkan.',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Virus Kuning (Gemini Virus)',
            'reason' => 'Virus Gemini. Virus ini ditularkan oleh kutu putih/kutu kebul Bemisia tabaci',
            'solution' => 'Untuk mengendalikan penyakit ini adalah dengan pemupukan yang berimbang, yaitu Urea 150-200 kg, ZA 450-500 kg, TSP 100-150 kg, KCl 100-150 kg, dan pupuk organik 20-30 ton per hektar dan penggunaan insektisida yang efektif dan selektif mengendalikan kutu putih sebagai vektor virus Gemini',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Bercak Daun',
            'reason' => 'Cercospora capsici',
            'solution' => 'Pengendalian penyakit ini dengan fungisida difenoconazole (Score ®250 EC dengan konsentrasi 0,5 ml/l). Interval penyemprotan 7 hari',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Busuk Daun Fitoftora',
            'reason' => 'Phytophthora capsici',
            'solution' => 'Untuk mengendalikan penyakit ini dapat dilakukan dengan membersihkan lahan dari sisa-sisa tanaman dan gulma sebelumnya dan penyemprotan fungisida secara bergilir antara fungisida sistemik satu kali (salah satu dari Acelalamine 0,5%, Dimmethomorph 0,1%, Propamocarb, Oxidasil 0,1%) dengan fungisida kontak seperti Klorotalonil 2% sebanyak tiga kali pada interval seminggu sekali.',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Kerupuk',
            'reason' => 'Chilli Puckery Stunt Virus (CPSV), patogen ditularkan oleh kutudaun Aphis gossypii ',
            'solution' => 'Penyakit ini dapat dikendalikan dengan cara penggunaan mulsa plastik perak di dataran tinggi, dan jerami di dataran rendah mengurangi infestasi kutu daun yang berperan sebagai vektor virus dan tanaman muda yang terinfeksi virus di lapangan dimusnahkan dan disulam dengan yang sehat',
            'image' => 'image1.jpg',
        ]);
    }
}
