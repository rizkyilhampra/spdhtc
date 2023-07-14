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
            'solution' => '1.	 Penggunaan mulsa perak di dataran tinggi, dan jerami di dataran rendah mengurangi infestasi serangga pengisap daun
            2.	Eradikasi tanaman sakit, yaitu tanaman yang menunjukkan gejala segera dicabut dan dimusnahkan supaya tidak menjadi sumber penularan ke tanaman lain yang sehat
            3.	Menanam varietas yang agak tahan (karena tidak ada yang tahan) misalnya cabai keriting jenis Bukittinggi
            4.	Melakukan rotasi / pergiliran tanaman dengan tanaman bukan inang. Melakukan sanitasi lingkungan
            5.  Lakukan pengendalian untuk gejala ringan dengan mengaplikasikan pgpr atau pupuk hayati
            6.  Pemupukan yang berimbang, yaitu 150-200 kg Urea, 450-500 kg Za, 100-150 kg TSP, 100-150 KCL, dan 20-30 ton pupuk organik per hektar
            7.    Usaha pengendalian penyakit virus kuning (khususnya dengan pestisida) terutama ditujukan kepada serangga vektornya
            ',
            'image' => '583706090.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Kerupuk',
            'reason' => 'Chilli Puckery Stunt Virus (CPSV), patogen ditularkan oleh kutudaun Aphis gossypii ',
            'solution' => '1.	 Tanaman muda yang terinfeksi virus di lapangan dimusnahkan dan disulam dengan yang sehat.
            2.	Penggunaan mulsa plastik perak di dataran tinggi, dan jerami di dataran rendah mengurangi infestasi kutudaun yang berperan sebagai vektor virus.
            3.  Intercropping antara cabai dan tomat di dataran tinggi dapat mengurangi serangan hama dan penyakit serta menaikkan hasil panen.
            4.  Pemupukan yang berimbang, yaitu Urea 150-200 kg, ZA 450-500 kg, TSP 100-150 kg, KCl 100-150 kg, dan pupuk organik 20-30 ton perhektar
            5.	Aplikasi insektisida untuk mengendalikan kutudaun menggunakan nozel kipas agar terjadi pengurangan volume inseksida sebanyak 30%.
            ',
            'image' => '868674832.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Antraknosa',
            'reason' => 'Jamur Colletotricum capsici dan Jamur Gloeosporium sp.',
            'solution' => '1.   Pengendalian secara fisik/mekanik, dengan eradikasi selektif dan sanitasi kebun.
            2.	Pengendalian secara bercocok tanam, meliputi pergiliran tanaman, perbaikan drainase, penentuan waktu tanam, penggunaan bibit sehat, penanaman varietas tahan.
            3.	Saat semai tanah dicampur kompos Trichoderma.
            4.	Perlakuan biji sebelum ditanam, direndam dengan Trichoderma 20 cc/liter air.
            5.  Pengendalian kimiawi, dengan menggunakan fungisida yang efektif yang telah diizinkan oleh Menteri Pertanian.
            ',
            'image' => '190785420.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Bercak Daun',
            'reason' => 'Cercospora Capsici',
            'solution' => '1.	 Pengendalian secara fisik/mekanik, dengan melakukan sanitasi, eradikasi selektif terhadap tanaman terserang.
            2.  Pengendalian secara bercocok tanam, meliputi pergiliran tanaman, perbaikan drainase, penentuan waktu tanam, penggunaan bibit sehat
            3.	Perlakuan biji sebelum ditanam, direndam dengan Trichoderma 20 cc/liter air.
            4.	Pemupukan organik seperti kompos Trichoderma atau bahan organic lain.
            5.	Pengendalian kimiawi, dengan aplikasi fungisida yang efektif yang telah diizinkan oleh Menteri Pertanian.
            ',
            'image' => '1640319795.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Busuk Daun Fitoftora',
            'reason' => 'Phytophthora Capsici',
            'solution' => '1.   Penggunaan mulsa plastik perak di dataran tinggi, dan jerami di dataran rendah mengurangi infestasi penyakit, terutama di musim hujan.
            2.  Tanaman muda yang terinfeksi penyakit di lapangan dimusnahkan dan disulam dengan yang sehat.
            3.	Intercropping antara cabai dan tomat di dataran tinggi dapat mengurangi serangan hama dan penyakit serta menaikkan hasil panen.
            4.	Pemupukan yang berimbang, yaitu Urea 150-200 kg, ZA 450-500 kg, TSP 100-150 kg, KCl 100-150 kg, dan pupuk organik 20-30 ton per hektar.
            5.	Cendawan Phytophthora capsici dapat dikendalikan dengan fungisida sistemik Metalaksil-M 4% + Mancozeb 64% (Ridomil Gold MZ ® 4/64 WP) pada konsentrasi 3 g/l air, bergantian dengan fungisida kontak seperti klorotalonil (Daconil ® 500 F, 2g/l). Fungisida sistemik digunakan maksimal empat kali per musim.
            6.	Untuk mengurangi penggunaan pestisida (+ 30%) dianjurkan untuk menggunakan nozel kipas yang butiran semprotannya berupa kabut dan merata.
            ',
            'image' => '1015219247.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Layu Fusarium',
            'reason' => 'Fusarium Oxysporum',
            'solution' => '1.   Penggunaan mulsa plastik perak di dataran tinggi, dan jerami di dataran rendah mengurangi penyakit tanah, terutama di musim hujan.
            2.  Tanaman muda yang terinfeksi penyakit dimusnahkan dan disulam dengan yang sehat.
            3.	Tanah-tanah yang terkontaminasi penyakit layu jangan digunakan. Infeksi penyakit layu dapat dipelajari pada tanaman sebelumnya.
            4.  Sterilkan tanah serta lakukan pencegahan dengan menggunakan pupuk organik yang sudah masak, kocorkan agens hayati (Trichoderma atau pgpr)
            5.  Membersihkan lahan dari sisa-sisa tanaman dan gulma sebelumnya. Membalik tanah agar terkena sinar matahari.
            6.	Intercropping antara cabai dan tomat di dataran tinggi dapat mengurangi serangan hama dan penyakit serta menaikkan hasil.
            7.	Pemupukan yang berimbang yaitu Urea 150-200 kg, ZA 450-500 kg, TSP 100-150 kg, KCl 100-150 kg, dan pupuk organik 20-30 ton per hektar.
            ',
            'image' => '1057130417.jpg',
        ]);

        ModelsPenyakit::create([
            'name' => 'Layu Bakteri',
            'reason' => 'Ralstonia Solanacearum ',
            'solution' => '1.   Semaian yang terinfeksi penyakit harus dicabut dan dimusnahkan, media tanah yang terkontaminasi dibuang.
            2.	Naungan persemaian secara bertahap dibuka agar matahari masuk dan tanaman menjadi lebih kuat.
            3.	Media untuk penyemaian menggunakan lapisan sub soil 1,5-2 m di bawah permukaan tanah), pupuk kandang matang yang halus dan pasir kali pada perbandingan 1:1:1. Campuran media ini dipasteurisasi selama 2 jam.
            4.  Sterilkan tanah serta lakukan pencegahan dengan menggunakan pupuk organik yang sudah masak, kocorkan agens hayati (Trichoderma atau pgpr)
            5.	Penggunaan fungisida/bakterisida selektif dengan dosis batas terendah.
            ',
            'image' => '289529137.jpg',
        ]);
    }
}
