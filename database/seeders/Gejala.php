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
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Tulang daun menebal dan daun menggulung ke atas',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Daun mengecil dan berwarna kuning terang',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Tanaman kerdil dan tidak berbuah',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Daun melengkung ke bawah',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Daun berwarna hijau pekat mengkilat dan permukaan tidak rata',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Pertumbuhan terhambat, ruas jarak antara tangkai daun lebih pendek terutama di bagian pucuk, sehingga daun menumpuk dan bergumpal-gumpal berkesan regas seperti kerupuk',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Daun gugur sehingga yang tinggal ranting dengan daun-daun menggulung diujung pucuk',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Bercak coklat kehitaman pada permukaan buah, kemudian menjadi busuk lunak',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Pada bagian tengah bercak terdapat kumpulan titik hitam yang merupakan kelompok spora',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Buah keriput dan mengering',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Warna kulit buah seperti jerami padi',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Bercak kecil berbentuk bulat dan kering',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Bercak meluas sampai diameter sekitar 0,5 cm',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Pusat bercak berwarna pucat sampai putih dengan warna tepi lebih tua',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Bercak terdapat pada batang, tangkai daun maupun tangkai buah',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Leher batang menjadi busuk basah berwarna hijau setelah kering warna menjadi coklat/hitam',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Batang menjadi kering mengeras dan seluruh daun menjadi layu',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Pada daun terdapat bercak putih seperti tersiram air panas berbentuk sirkuler atau tidak beraturan',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Bercak melebar mengering seperti kertas dan akhirnya memutih',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Tanaman yang terserang menjadi layu, mulai dari daun bagian bawah dan anak tulang daun menguning',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Warna jaringan akar dan batang menjadi coklat',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Tempat luka infeksi tertutup hifa yang berwarna putih seperti kapas',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Warna daun tetap hijau tetapi tanaman layu',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Gejala layu tampak pada daun–daun yang terletak di bagian bawah',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Jaringan vaskuler dari batang bagian bawah dan akar menjadi kecoklatan',
            'image' => 'image1.jpg',
        ]);

        ModelsGejala::create([
            'name' => 'Apabila batang atau akar tersebut dipotong melintang dan dicelupkan ke dalam air jernih akan keluar cairan keruh koloni bakteri yang melayang dalam air menyerupai kepulan asap',
            'image' => 'image1.jpg',
        ]);
    }
}
