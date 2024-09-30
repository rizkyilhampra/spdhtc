# SPDHTC
## Deskripsi
Sistem pakar (*web based*) dengan *forward chaining algorithm* sebagai *inference engine* untuk diagnosis penyakit pada tanaman cabai. Menerima masukan berupa gejala-gejala yang dapat di amati dan memberikan hasil diagnosis penyakit beserta penyebab dan solusinya.

## Daftar Isi
- [Deskripsi](#deskripsi)
- [Daftar Isi](#daftar-isi)
- [Dataset](#dataset)
- [Teknologi yang digunakan](#teknologi-yang-digunakan)
- [Fitur](#fitur)
- [Cara menjalankan aplikasi di local](#cara-menjalankan-aplikasi-di-local)
    * [Menjalankan dengan XAMPP/Laragon](#menjalankan-dengan-xampplaragon)
        - [Persyaratan](#persyaratan)
        - [Langkah-langkah](#langkah-langkah)
    * [Menjalankan dengan `php artisan serve`](#menjalankan-dengan-php-artisan-serve)
        - [Persyaratan](#persyaratan-1)
        - [Langkah-langkah](#langkah-langkah-1)
    * [Menjalankan dengan Docker/Sail](#menjalankan-dengan-docker-sail)
      - [Persyaratan](#persyaratan-2)
      - [Langkah-langkah](#langkah-langkah-2)
- [Setelah aplikasi berjalan](#setelah-aplikasi-berjalan)
- [FAQ](#faq)
- [TODO](#todo)
- [Kebijakan Privasi](#kebijakan-privasi)

## Dataset
Dataset yang digunakan dapat dilihat di [sini](https://github.com/rizkyilhampra/spdhtc/blob/master/dataset.md). 

## Teknologi yang digunakan
- Laravel 11
- JQuery
- Bootstrap 5
- dan *library pre-existing* lainnya

## Fitur
- [x] Login dan Register (termasuk penggunaan OAuth Google)
- [x] Email Verification
- [x] Forgot Password
- [x] Manajemen dataset
- [x] Integrasi dengan API pihak ketiga
- [x] Riwayat diagnosis
- [x] Manajemen profil

## Cara menjalankan aplikasi
### Menjalankan dengan XAMPP/Laragon
#### Persyaratan
- Git (opsional)
- PHP 8.0 (minimal)
- Composer
- MySQL atau MariaDB
- Web server 

#### Langkah-langkah
> [!NOTE]
> Tanda `i` `ii` dan seterusnya menunjukkan **opsi** yang dapat dipilih, **bukan untuk dijalankan satu per satu**.
    
1. Masuk ke direktori *root* dari web server atau *local development environment*
    > Misalnya, untuk XAMPP di Windows, direktori root biasanya berada di `C:\xampp\htdocs` dan untuk Laragon, biasanya berada di `C:\laragon\www`
2. *Clone* repositori atau *download* ZIP di [sini](https://github.com/rizkyilhampra/spdhtc/releases) kemudian ekstraksi
    1. *Clone* menggunakan Git 
       > Abaikan langkah ini, jika memilih *download* ZIP
    
        ```bash
        git clone https://github.com/rizkyilhampra/spdhtc.git spdhtc
        ```
3. Masuk ke direktori/folder `spdhtc`
    1. Menggunakan CLI berbasis Unix
        ```bash
        cd spdhtc
        ```
    2. Melalui *file manager*
       - Buka *file manager* dan arahkan ke direktori/folder `spdhtc`
4. Install dependensi
    > Pastikan PHP dan Composer sudah terinstall!
    ```bash
    composer install
    ```
5. *Copy file* `.env.example` kemudian *paste* di tempat yang sama, lalu ubah nama *file* menjadi `.env`
    1. Menggunakan CLI berbasis Unix
        ```bash
        cp .env.example .env
        ```
6. Buat *database* baru
    1. Menggunakan CLI
        ```bash
        mysql -u root -p
        ```
        ```sql
        CREATE DATABASE spdhtc;
        exit;
        ```
    2. Menggunakan *database management tool* seperti PHPMyAdmin
        - Buka PHPMyAdmin
        - Buat *database* baru dengan nama `spdhtc`
7. Konfigurasi *database* pada file `.env`
    > Buka file `.env` menggunakan *text editor* (Visual Studio Code, Notepad/Notepad++, VIM/Neovim, Atom, Jetbrains, Zed, Helix, dan lain sebagainya) kemudian ubah konfigurasi *database* sesuai dengan konfigurasi *database* yang telah dibuat sebelumnya

    ```diff
    DB_CONNECTION=mysql
    DB_HOST=128.0.0.1
    DB_PORT=3307
    - DB_DATABASE=laravel
    + DB_DATABASE=spdhtc
    DB_USERNAME=root #sesuaikan dengan username MySQL
    DB_PASSWORD= #sesuaikan dengan password MySQL (kosongkan jika tidak ada)
    ```
8. Tambahkan Google kredensial (Opsional)
    > Ini berhubungan dengan fitur login dan register. Mengabaikan ini maka login dan register dengan akun Google tidak akan berjalan.
    ```bash
    # NOTE: dapatkan dari https://console.cloud.google.com
    GOOGLE_CLIENT_ID= #isi dengan client id google
    GOOGLE_CLIENT_SECRET= #isi dengan client secret google
    ```
9. Tambahkan Rajaongkir kredensial (Opsional dengan [**catatan**](https://github.com/rizkyilhampra/spdhtc/discussions/71))
    ```bash
    # NOTE: dapatkan dari https://rajaongkir.com/dokumentasi
    RAJAONGKIR_API_KEY= #isi
    ```
10. *Generate key* aplikasi
    > Jalankan melalui terminal
    ```bash
    php artisan key:generate
    ```
11. Migrasi *database* dan *seed* data
    ```bash
    php artisan migrate:fresh --seed
    ```
12. *Link storage*
    > Ini berfungsi untuk mengakses file yang ada di direktori `storage/app/public`  atau dalam kata lain untuk menampilkan gambar penyakit
    ```bash
    php artisan storage:link
    ```
13. Buka browser dan akses `http://localhost/spdhtc/public` atau `http://spdhtc.test`

### Menjalankan dengan `php artisan serve`
<details>
    <summary>
        Klik disini untuk melihat
    </summary>

#### Persyaratan 
- Git 
- PHP 8.0 (minimal)
- Composer
- MySQL atau MariaDB

#### Langkah-langkah
1. Clone repositori 
    ```bash
    git clone https://github.com/rizkyilhampra/spdhtc.git spdhtc
    ```
2. Masuk ke direktori/folder `spdhtc`
    ```bash
    cd spdhtc
    ```
3. Install dependensi
    ```bash
    composer install
    ```
4. Copy file `.env.example` menjadi `.env`
    ```bash
    cp .env.example .env
    ```
5. Konfigurasi *database* pada file `.env`
    ```diff
    DB_CONNECTION=mysql
    DB_HOST=128.0.0.1
    DB_PORT=3307
    - DB_DATABASE=laravel
    + DB_DATABASE=spdhtc
    DB_USERNAME=root #sesuaikan dengan username MySQL
    DB_PASSWORD= #sesuaikan dengan password MySQL (kosongkan jika tidak ada)
    ```
6. Tambahkan Google kredensial pada file `.env` (Opsional)
    > Ini akan berhubungan dengan fitur login dan register. Mengabaikan ini maka login dan register dengan akun Google tidak akan berjalan.
    ```bash
    # NOTE: dapatkan dari https://console.cloud.google.com
    GOOGLE_CLIENT_ID= #isi dengan client id google
    GOOGLE_CLIENT_SECRET= #isi dengan client secret google
    ```
7. Tambahkan Rajaongkir kredensial pada file `.env` (Opsional dengan [catatan](https://github.com/rizkyilhampra/spdhtc/discussions/71))
    ```bash
    # NOTE: dapatkan dari https://rajaongkir.com/dokumentasi
    RAJAONGKIR_API_KEY= #isi
    ```
8. Generate key aplikasi
    ```bash
    php artisan key:generate
    ```
9. Migrasi *database* dan *seed* data
    > Pada umumnya, perintah ini akan membuat datatabase secara otomatis tanpa perlu membuat terlebih dahulu, jika mengalami kendala,  buat database manual
    ```bash
    php artisan migrate:fresh --seed
    ```
10. Link storage
    ```bash
    php artisan storage:link
    ```
11. Jalankan aplikasi
    ```bash
    php artisan serve
    ```
12. Buka browser dan akses `http://localhost:8000`

</details>

### Menjalankan dengan Docker/Sail
> [!NOTE]
> Hanya tersedia di versi v2.1-beta ke atas

<details>
    <summary>
        Klik disini untuk melihat
    </summary>

#### Persyaratan
- Git 
- Docker Desktop (Windows/Mac) atau Docker Engine (Linux)

#### Langkah-langkah
1. Clone repositori 
    ```bash
    git clone https://github.com/rizkyilhampra/spdhtc.git spdhtc
    ```
2. Masuk ke direktori/folder `spdhtc`
    ```bash
    cd spdhtc
    ```
3. Install dependensi dengan docker, copy file `.env.example` menjadi `.env`, dan generate key
    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php81-composer:latest \
        composer install --ignore-platform-reqs; \
        cp .env.example .env; \
        php artisan key:generate
    ```
4. Konfigurasi host *database* pada file `.env`
    ```diff
    DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    + DB_HOST=mysql
    DB_PORT=3306
    ```
5. Tambahkan Google kredensial pada file `.env` (Opsional)
    > Ini berhubungan dengan fitur login dan register. Mengabaikan ini maka login dan register dengan akun Google tidak akan berjalan.
    ```bash
    # NOTE: dapatkan dari https://console.cloud.google.com
    GOOGLE_CLIENT_ID= #isi dengan client id google
    GOOGLE_CLIENT_SECRET= #isi dengan client secret google
    ```
6. Tambahkan Rajaongkir kredensial pada file `.env` (Opsional dengan [catatan](https://github.com/rizkyilhampra/spdhtc/discussions/71))
    ```bash
    # NOTE: dapatkan dari https://rajaongkir.com/dokumentasi
    RAJAONGKIR_API_KEY= #isi
    ```
7. Jalankan *container* 
    ```bash
    ./vendor/bin/sail up -d
    ```
8. Migrasi *database* dan *seed* data
    ```bash
    ./vendor/bin/sail artisan migrate:fresh --seed
    ```
9. Link storage
    ```bash
    ./vendor/bin/sail artisan storage:link
    ```
10. Buka browser dan akses `http://localhost`

</details>

## Setelah aplikasi berjalan
Secara default saat *seeding* data, akan dibuatkan 2 akun pengguna. Sehingga untuk dapat login ke dalam aplikasi, dapat menggunakan data berikut.

https://github.com/rizkyilhampra/spdhtc/blob/565a8e31dbf0c34761c994d328973c44b5182c1e/database/seeders/UserCustomSeeder.php#L18-L25

> [!NOTE]
> *password* untuk masing-masing akun adalah `password`. Lihat di [`UserFactory.php`](https://github.com/rizkyilhampra/spdhtc/blob/master/database/factories/UserFactory.php)

## FAQ
Cek beberapa pertanyaan lainnya atau buat pertanyaan baru jika belum ada, [disini](https://github.com/rizkyilhampra/spdhtc/discussions/categories/q-a)

## TODO
- [x] Write better documentation
- [x] Release v2.0 (stable)
- [x] Upgrade to Laravel 11

## Kebijakan Privasi
Kebijakan privasi di [SPDHTC](https://spdhtc.rizkyilhampra.me) dapat dilihat [disini](https://github.com/rizkyilhampra/spdhtc/blob/master/privacy.md)
