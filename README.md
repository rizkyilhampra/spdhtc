# SPDHTC

## Deskripsi

Sistem pakar (_web based_) dengan _forward chaining algorithm_ sebagai _inference engine_ untuk diagnosis penyakit pada tanaman cabai. Menerima masukan berupa gejala-gejala yang dapat di amati dan memberikan hasil diagnosis penyakit beserta penyebab dan solusinya.

## Daftar Isi

-   [Deskripsi](#deskripsi)
-   [Daftar Isi](#daftar-isi)
-   [Dataset](#dataset)
-   [Teknologi yang digunakan](#teknologi-yang-digunakan)
-   [Fitur](#fitur)
-   [Cara menjalankan aplikasi](#cara-menjalankan-aplikasi)
    -   [Menjalankan dengan XAMPP/Laragon](#menjalankan-dengan-xampplaragon)
    -   [Menjalankan dengan `php artisan serve`](#menjalankan-dengan-php-artisan-serve)
    -   [Menjalankan dengan Docker/Sail](#menjalankan-dengan-docker-sail)
-   [Setelah aplikasi berjalan](#setelah-aplikasi-berjalan)
-   [FAQ](#faq)
-   [TODO](#todo)
-   [Kebijakan Privasi](#kebijakan-privasi)
-   [Lisensi](#lisensi)

## Dataset

> A data set (or dataset) is a collection of data it can also consist of a collection of documents or files[^1].

[^1]: https://en.wikipedia.org/wiki/Data_set#cite_ref-Editorial_2-0

_Dataset_ yang digunakan dalam aplikasi atau sistem ini dapat dilihat di [sini](https://github.com/rizkyilhampra/spdhtc/blob/master/COPYING)

## Teknologi yang digunakan

-   Laravel 11
-   JQuery
-   Bootstrap 5
-   dan _library pre-existing_ lainnya

## Fitur

-   [x] Login dan Register (termasuk penggunaan OAuth Google)
-   [x] Email Verification
-   [x] Forgot Password
-   [x] Manajemen dataset
-   [x] Integrasi dengan API pihak ketiga
-   [x] Riwayat diagnosis
-   [x] Manajemen profil

## Cara menjalankan aplikasi

### Menjalankan dengan XAMPP/Laragon

#### Persyaratan

-   Git (opsional)
-   PHP 8.2 (minimal)
-   Composer
-   MySQL atau MariaDB
-   Web server

#### Langkah-langkah

> [!NOTE]
> Tanda `i` `ii` dan seterusnya menunjukkan **opsi** yang dapat dipilih, **bukan untuk dijalankan satu per satu**.

1. Masuk ke direktori _root_ dari web server atau _local development environment_
    > Misalnya, untuk XAMPP di Windows, direktori root biasanya berada di `C:\xampp\htdocs` dan untuk Laragon, biasanya berada di `C:\laragon\www`
2. _Clone_ repositori atau _download_ ZIP di [sini](https://github.com/rizkyilhampra/spdhtc/releases) kemudian ekstraksi

    1. _Clone_ menggunakan Git

        > Abaikan langkah ini, jika memilih _download_ ZIP

        ```bash
        git clone https://github.com/rizkyilhampra/spdhtc.git spdhtc
        ```

3. Masuk ke direktori/folder `spdhtc`
    1. Menggunakan CLI berbasis Unix
        ```bash
        cd spdhtc
        ```
    2. Melalui _file manager_
        - Buka _file manager_ dan arahkan ke direktori/folder `spdhtc`
4. Install dependensi
    > Pastikan PHP dan Composer sudah terinstall!
    ```bash
    composer install
    ```
5. _Copy file_ `.env.example` kemudian _paste_ di tempat yang sama, lalu ubah nama _file_ menjadi `.env`
    1. Menggunakan CLI berbasis Unix
        ```bash
        cp .env.example .env
        ```
6. Buat _database_ baru
    1. Menggunakan CLI
        ```bash
        mysql -u root -p
        ```
        ```sql
        CREATE DATABASE spdhtc;
        exit;
        ```
    2. Menggunakan _database management tool_ seperti PHPMyAdmin
        - Buka PHPMyAdmin
        - Buat _database_ baru dengan nama `spdhtc`
7. Konfigurasi _database_ pada file `.env`

    > Buka file `.env` menggunakan _text editor_ (Visual Studio Code, Notepad/Notepad++, VIM/Neovim, Atom, Jetbrains, Zed, Helix, dan lain sebagainya) kemudian ubah konfigurasi _database_ sesuai dengan konfigurasi _database_ yang telah dibuat sebelumnya

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
10. _Generate key_ aplikasi
    > Jalankan melalui terminal
    ```bash
    php artisan key:generate
    ```
11. Migrasi _database_ dan _seed_ data
    ```bash
    php artisan migrate:fresh --seed
    ```
12. _Link storage_
    > Ini berfungsi untuk mengakses file yang ada di direktori `storage/app/public` atau dalam kata lain untuk menampilkan gambar penyakit
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

-   Git
-   PHP 8.0 (minimal)
-   Composer
-   MySQL atau MariaDB

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
5. Konfigurasi _database_ pada file `.env`
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
9. Migrasi _database_ dan _seed_ data
    > Pada umumnya, perintah ini akan membuat datatabase secara otomatis tanpa perlu membuat terlebih dahulu, jika mengalami kendala, buat database manual
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

<details>
    <summary>
        Klik disini untuk melihat
    </summary>

#### Persyaratan

-   Git
-   Docker Desktop (Windows/Mac) atau Docker Engine (Linux)

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
4. Konfigurasi host _database_ pada file `.env`
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
7. Jalankan _container_
    ```bash
    ./vendor/bin/sail up -d
    ```
8. Migrasi _database_ dan _seed_ data
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

Secara default saat _seeding_ data, akan dibuatkan 2 akun pengguna. Sehingga untuk dapat login ke dalam aplikasi, dapat menggunakan data berikut.

https://github.com/rizkyilhampra/spdhtc/blob/565a8e31dbf0c34761c994d328973c44b5182c1e/database/seeders/UserCustomSeeder.php#L18-L25

<!--prettier-ignore-->
> [!NOTE]
> _Password_ untuk masing-masing akun adalah `password`. Lihat di [`UserFactory.php`](https://github.com/rizkyilhampra/spdhtc/blob/master/database/factories/UserFactory.php)

## FAQ

Cek beberapa pertanyaan lainnya atau buat pertanyaan baru jika belum ada, di [sini](https://github.com/rizkyilhampra/spdhtc/discussions/categories/q-a)

## TODO

-   [x] Write better documentation
-   [x] Release v2.0 (stable)
-   [x] Upgrade to Laravel 11

## Kebijakan Privasi

Hal-hal yang berkaitan dengan privasi dan kebijakannya di [SPDHTC](https://spdhtc.rizkyilhampra.me), dapat dilihat di [sini](https://github.com/rizkyilhampra/spdhtc/discussions/categories/q-a?discussions_q=category%3AQ%26A+)

## Lisensi

Per rilis dari _initial release_ sampai [v2.0-beta](https://github.com/rizkyilhampra/spdhtc/releases/tag/v2.0-beta), aplikasi ini juga di bawah hak cipta suatu instansi atau bersifat _dual license_. Dikarenakan terdapat beberapa perubahan dari [v2.0-beta](https://github.com/rizkyilhampra/spdhtc/releases/tag/v2.0-beta) sampai pada [v2.0-stable](https://github.com/rizkyilhampra/spdhtc/releases/tag/v2.0) dan seterusnya. Maka, kami sebagai pengembang aplikasi dan _stakeholder_ pertama, menempatkan aplikasi ini **hanya di bawah lisensi [WTFPL](https://github.com/rizkyilhampra/spdhtc/blob/master/COPYING)**. Adapun yang di maksud dari lisensi tersebut adalah bahwa aplikasi ini dapat digunakan, dimodifikasi, dan didistribusikan secara bebas tanpa ada batasan apapun. Untuk hal-hal lainnya yang memiliki lisensinya masing-masing, kami teruskan kepada _stakeholder_ yang bersangkutan.
