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
            'name' => 'sekitar tulang daun menebal berwarna hijau tua dan daun berwarna kuning',
            'image' => '2010365565.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'tulang daun menebal dan daun menggulung ke atas',
            'image' => '1677054521.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'daun mengecil dan berwarna kuning terang',
            'image' => '1393673814.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'tanaman kerdil dan tidak berbuah',
            'image' => '312554642.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'daun melengkung ke bawah',
            'image' => '994293537.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'daun berwarna hijau pekat mengkilat dan permukaan tidak rata',
            'image' => '1033422542.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'pertumbuhan terhambat, ruas jarak antara tangkai daun lebih pendek terutama di bagian pucuk, sehingga daun menumpuk dan bergumpal-gumpal berkesan regas seperti kerupuk',
            'image' => '10451236.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'daun gugur sehingga yang tinggal ranting dengan daun-daun menggulung diujung pucuk',
            'image' => '1629543921.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'terdapat bercak coklat kehitaman pada permukaan buah, kemudian menjadi busuk lunak',
            'image' => '302231025.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'pada bagian tengah bercak terdapat kumpulan titik hitam yang merupakan kelompok spora',
            'image' => '1717037255.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'buah keriput dan mengering',
            'image' => '1287292971.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'warna kulit buah seperti jerami padi',
            'image' => '494455965.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'terdapat bercak kecil berbentuk bulat dan kering',
            'image' => '371037560.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'bercak meluas sampai diameter sekitar 0,5 cm',
            'image' => '634932613.png',
        ]);

        ModelsGejala::create([
            'name' => 'pusat bercak berwarna pucat sampai putih dengan warna tepi lebih tua',
            'image' => '549491915.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'bercak terdapat pada batang, tangkai daun maupun tangkai buah',
            'image' => '945179807.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'leher batang menjadi busuk basah berwarna hijau setelah kering warna menjadi coklat/hitam',
            'image' => '363776952.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'batang menjadi kering mengeras dan seluruh daun menjadi layu',
            'image' => '1396971721.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'pada daun terdapat bercak putih seperti tersiram air panas berbentuk sirkuler atau tidak beraturan',
            'image' => '781410053.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'bercak melebar mengering seperti kertas dan akhirnya memutih',
            'image' => '845929390.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'tanaman yang terserang menjadi layu, mulai dari daun bagian bawah dan anak tulang daun menguning',
            'image' => '1689767428.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'warna jaringan akar dan batang menjadi coklat',
            'image' => '423226577.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'tempat luka infeksi tertutup hifa yang berwarna putih seperti kapas',
            'image' => '1618232509.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'warna daun tetap hijau tetapi tanaman layu',
            'image' => '131427708.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'gejala layu tampak pada daun–daun yang terletak di bagian bawah',
            'image' => '1133327384.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'jaringan vaskuler dari batang bagian bawah dan akar menjadi kecoklatan',
            'image' => '608939258.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'apabila batang atau akar tersebut dipotong melintang dan dicelupkan ke dalam air jernih akan keluar cairan keruh koloni bakteri yang melayang dalam air menyerupai kepulan asap',
            'image' => '1928027606.jpg',
        ]);
    }
}
