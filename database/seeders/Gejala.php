<?php

namespace Database\Seeders;

use App\Models\Gejala as ModelsGejala;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Gejala extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //prefix
        //name
        //image

        ModelsGejala::create([
            'name' => 'Helai daun mengalami vein clearing dimulai dari daun pucuk berkembang menjadi warna kuning jelas',
            'image' => '2010365565.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Tulang daun menebal dan daun menggulung ke atas',
            'image' => '1677054521.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Daun mengecil dan berwarna kuning terang',
            'image' => '1393673814.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Tanaman kerdil dan tidak berbuah',
            'image' => '312554642.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Daun melengkung ke bawah',
            'image' => '994293537.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Daun berwarna hijau pekat mengkilat dan permukaan tidak rata',
            'image' => '1033422542.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Pertumbuhan terhambat, ruas jarak antara tangkai daun lebih pendek terutama di bagian pucuk, sehingga daun menumpuk dan bergumpal-gumpal berkesan regas seperti kerupuk',
            'image' => '10451236.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Daun gugur sehingga yang tinggal ranting dengan daun-daun menggulung diujung pucuk',
            'image' => '1629543921.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Bercak coklat kehitaman pada permukaan buah, kemudian menjadi busuk lunak',
            'image' => '302231025.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Pada bagian tengah bercak terdapat kumpulan titik hitam yang merupakan kelompok spora',
            'image' => '1717037255.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Buah keriput dan mengering',
            'image' => '1287292971.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Warna kulit buah seperti jerami padi',
            'image' => '494455965.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Bercak kecil berbentuk bulat dan kering',
            'image' => '371037560.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Bercak meluas sampai diameter sekitar 0,5 cm',
            'image' => '634932613.png',
        ]);

        ModelsGejala::create([
            'name' => 'Pusat bercak berwarna pucat sampai putih dengan warna tepi lebih tua',
            'image' => '549491915.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Bercak terdapat pada batang, tangkai daun maupun tangkai buah',
            'image' => '945179807.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Leher batang menjadi busuk basah berwarna hijau setelah kering warna menjadi coklat/hitam',
            'image' => '363776952.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Batang menjadi kering mengeras dan seluruh daun menjadi layu',
            'image' => '1396971721.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Pada daun terdapat bercak putih seperti tersiram air panas berbentuk sirkuler atau tidak beraturan',
            'image' => '781410053.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Bercak melebar mengering seperti kertas dan akhirnya memutih',
            'image' => '845929390.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Tanaman yang terserang menjadi layu, mulai dari daun bagian bawah dan anak tulang daun menguning',
            'image' => '1689767428.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Warna jaringan akar dan batang menjadi coklat',
            'image' => '423226577.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Tempat luka infeksi tertutup hifa yang berwarna putih seperti kapas',
            'image' => '1618232509.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Warna daun tetap hijau tetapi tanaman layu',
            'image' => '131427708.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Gejala layu tampak pada daun–daun yang terletak di bagian bawah',
            'image' => '1133327384.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Jaringan vaskuler dari batang bagian bawah dan akar menjadi kecoklatan',
            'image' => '608939258.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Apabila batang atau akar tersebut dipotong melintang dan dicelupkan ke dalam air jernih akan keluar cairan keruh koloni bakteri yang melayang dalam air menyerupai kepulan asap',
            'image' => '1928027606.jpg',
        ]);
    }
}
