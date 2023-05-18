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
            'name' => 'Virus Kuning (Gemini Virus)',
            'reason' => 'Virus Gemini. Virus ini ditularkan oleh kutu putih/kutu kebul Bemisia tabaci',
            'solution' => '1.	Usaha pengendalian penyakit virus kuning (khususnya dengan pestisida) terutama ditujukan kepada serangga vektornya
            2.	Pemupukan yang berimbang, yaitu 150-200 kg Urea, 450-500 kg Za, 100-150 kg TSP, 100-150 KCL, dan 20-30 ton pupuk organik per hektar
            3.	Menanam varietas yang agak tahan (karena tidak ada yang tahan) misalnya cabai keriting jenis Bukittinggi
            4.	Melakukan rotasi / pergiliran tanaman dengan tanaman bukan inang. Melakukan sanitasi lingkungan
            5.	Penggunaan mulsa perak di dataran tinggi, dan jerami di dataran rendah mengurangi infestasi serangga pengisap daun
            6.	Eradikasi tanaman sakit, yaitu tanaman yang menunjukkan gejala segera dicabut dan dimusnahkan supaya tidak menjadi sumber penularan ke tanaman lain yang sehat
            ',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Kerupuk',
            'reason' => 'Chilli Puckery Stunt Virus (CPSV), patogen ditularkan oleh kutudaun Aphis gossypii ',
            'solution' => '1.	Pemupukan yang berimbang, yaitu Urea 150-200 kg, ZA 450-500 kg, TSP 100-150 kg, KCl 100-150 kg, dan pupuk organik 20-30 ton perhektar
            2.	Intercropping antara cabai dan tomat di dataran tinggi dapat mengurangi serangan hama dan penyakit serta menaikkan hasil panen.
            3.	Penggunaan mulsa plastik perak di dataran tinggi, dan jerami di dataran rendah mengurangi infestasi kutudaun yang berperan sebagai vektor virus.
            4.	Tanaman muda yang terinfeksi virus di lapangan dimusnahkan dan disulam dengan yang sehat.
            5.	Aplikasi insektisida untuk mengendalikan kutudaun menggunakan nozel kipas agar terjadi pengurangan volume inseksida sebanyak 30%.
            ',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Antraknosa',
            'reason' => 'Jamur Colletotricum capsici dan Jamur Gloeosporium sp.',
            'solution' => '1.	Pengendalian secara bercocok tanam, meliputi pergiliran tanaman, perbaikan drainase, penentuan waktu tanam, penggunaan bibit sehat, penanaman varietas tahan.
            2.	Pengendalian secara fisik/mekanik, dengan eradikasi selektif dan sanitasi kebun.
            3.	Pengendalian kimiawi, dengan menggunakan fungisida yang efektif yang telah diizinkan oleh Menteri Pertanian.
            4.	Perlakuan biji sebelum ditanam, direndam dengan Trichoderma 20 cc/liter air.
            5.	Saat semai tanah dicampur kompos Trichoderma.
            ',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Bercak Daun',
            'reason' => 'Cercospora Capsici',
            'solution' => '1.	Pengendalian secara bercocok tanam, meliputi pergiliran tanaman, perbaikan drainase, penentuan waktu tanam, penggunaan bibit sehat
            2.	Pengendalian secara fisik/mekanik, dengan melakukan sanitasi, eradikasi selektif terhadap tanaman terserang.
            3.	Perlakuan biji sebelum ditanam, direndam dengan Trichoderma 20 cc/liter air.
            4.	Pemupukan organik seperti kompos Trichoderma atau bahan organic lain.
            5.	Pengendalian kimiawi, dengan aplikasi fungisida yang efektif yang telah diizinkan oleh Menteri Pertanian.
            ',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Busuk Daun Fitoftora',
            'reason' => 'Phytophthora Capsici',
            'solution' => '1.	Pemupukan yang berimbang, yaitu Urea 150-200 kg, ZA 450-500 kg, TSP 100-150 kg, KCl 100-150 kg, dan pupuk organik 20-30 ton per hektar.
            2.	Intercropping antara cabai dan tomat di dataran tinggi dapat mengurangi serangan hama dan penyakit serta menaikkan hasil panen.
            3.	Penggunaan mulsa plastik perak di dataran tinggi, dan jerami di dataran rendah mengurangi infestasi penyakit, terutama di musim hujan.
            4.	Tanaman muda yang terinfeksi penyakit di lapangan dimusnahkan dan disulam dengan yang sehat.
            5.	Cendawan Phytophthora capsici dapat dikendalikan dengan fungisida sistemik Metalaksil-M 4% + Mancozeb 64% (Ridomil Gold MZ ® 4/64 WP) pada konsentrasi 3 g/l air, bergantian dengan fungisida kontak seperti klorotalonil (Daconil ® 500 F, 2g/l). Fungisida sistemik digunakan maksimal empat kali per musim.
            6.	Untuk mengurangi penggunaan pestisida (+ 30%) dianjurkan untuk menggunakan nozel kipas yang butiran semprotannya berupa kabut dan merata.
            ',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Layu Fusarium',
            'reason' => 'Fusarium Oxysporum',
            'solution' => '1.	Tanah-tanah yang terkontaminasi penyakit layu jangan digunakan. Infeksi penyakit layu dapat dipelajari pada tanaman sebelumnya.
            2.	Membersihkan lahan dari sisa-sisa tanaman dan gulma sebelumnya. Membalik tanah agar terkena sinar matahari.
            3.	Pemupukan yang berimbang yaitu Urea 150-200 kg, ZA 450-500 kg, TSP 100-150 kg, KCl 100-150 kg, dan pupuk organik 20-30 ton per hektar.
            4.	Intercropping antara cabai dan tomat di dataran tinggi dapat mengurangi serangan hama dan penyakit serta menaikkan hasil.
            5.	Penggunaan mulsa plastik perak di dataran tinggi, dan jerami di dataran rendah mengurangi penyakit tanah, terutama di musim hujan.
            6.	Tanaman muda yang terinfeksi penyakit dimusnahkan dan disulam dengan yang sehat.
            ',
            'image' => 'image1.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Layu Bakteri',
            'reason' => 'Ralstonia Solanacearum ',
            'solution' => '1.	Media untuk penyemaian menggunakan lapisan sub soil 1,5-2 m di bawah permukaan tanah), pupuk kandang matang yang halus dan pasir kali pada perbandingan 1:1:1. Campuran media ini dipasteurisasi selama 2 jam.
            2.	Semaian yang terinfeksi penyakit harus dicabut dan dimusnahkan, media tanah yang terkontaminasi dibuang.
            3.	Naungan persemaian secara bertahap dibuka agar matahari masuk dan tanaman menjadi lebih kuat.
            4.	 Penggunaan fungisida/bakterisida selektif dengan dosis batas terendah.
            ',
            'image' => 'image1.jpg',
        ]);
    }
}
