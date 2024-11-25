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
    -   [Akun Pengguna](#akun-pengguna)
    -   [Email Verification](#email-verification)
-   [Bantuan & Kontak](#bantuan--kontak)
-   [Roadmap](#roadmap)
-   [Next](#next)
-   [Lisensi](#lisensi)

## Dataset

> *A data set (or dataset) is a collection of data it can also consist of a collection of documents or files*[^1].

[^1]: https://en.wikipedia.org/wiki/Data_set#cite_ref-Editorial_2-0

_Dataset_ yang digunakan dalam aplikasi atau sistem ini dapat dilihat di [sini](https://github.com/rizkyilhampra/spdhtc/blob/master/COPYING)

## Teknologi yang digunakan

-   Laravel 11
-   JQuery
-   Bootstrap 5
-   dan _library pre-existing_ lainnya

## Fitur

-   ✅ Login dan Register (termasuk penggunaan OAuth Google)
-   ✅ Email Verification
-   ✅ Forgot Password
-   ✅ Manajemen dataset
-   ✅ Integrasi dengan API pihak ketiga
-   ✅ Riwayat diagnosis
-   ✅ Manajemen profil
-   ✅ Login sebagai Tamu (***New*** 🎉) 

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

    > Buka file `.env` menggunakan _text editor_ (Visual Studio Code, Notepad/Notepad++, VIM/Neovim, atau lainnya) kemudian ubah konfigurasi _database_ sesuai dengan konfigurasi _database_ yang telah dibuat sebelumnya

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
    > Ini berhubungan dengan Login/Register via OAuth Google. Mengabaikan ini maka *login/register* dengan akun Google tidak akan berfungsi.
    ```bash
    # NOTE: dapatkan dari https://console.cloud.google.com
    GOOGLE_CLIENT_ID=
    GOOGLE_CLIENT_SECRET=
    ```
9. Tambahkan Rajaongkir kredensial (Opsional dengan [**catatan**](https://github.com/rizkyilhampra/spdhtc/discussions/71))
    ```bash
    # NOTE: dapatkan dari https://rajaongkir.com/dokumentasi
    RAJAONGKIR_API_KEY=
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
-   PHP 8.2 (minimal)
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
    > Ini berhubungan dengan Login/Register via OAuth Google. Mengabaikan ini maka *login/register* dengan akun Google tidak akan berfungsi.
    ```bash
    # NOTE: dapatkan dari https://console.cloud.google.com
    GOOGLE_CLIENT_ID=
    GOOGLE_CLIENT_SECRET=
    ```
7. Tambahkan Rajaongkir kredensial pada file `.env` (Opsional dengan [catatan](https://github.com/rizkyilhampra/spdhtc/discussions/71))
    ```bash
    # NOTE: dapatkan dari https://rajaongkir.com/dokumentasi
    RAJAONGKIR_API_KEY=
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
    > Ini berhubungan dengan Login/Register via OAuth Google. Mengabaikan ini maka *login/register* dengan akun Google tidak akan berfungsi.
    ```bash
    # NOTE: dapatkan dari https://console.cloud.google.com
    GOOGLE_CLIENT_ID=
    GOOGLE_CLIENT_SECRET=
    ```
6. Tambahkan Rajaongkir kredensial pada file `.env` (Opsional dengan [catatan](https://github.com/rizkyilhampra/spdhtc/discussions/71))
    ```bash
    # NOTE: dapatkan dari https://rajaongkir.com/dokumentasi
    RAJAONGKIR_API_KEY=
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

### Akun Pengguna

Secara default saat _seeding_ data, akan dibuatkan 2 akun pengguna. Sehingga untuk dapat login ke dalam aplikasi, dapat menggunakan data berikut.

https://github.com/rizkyilhampra/spdhtc/blob/565a8e31dbf0c34761c994d328973c44b5182c1e/database/seeders/UserCustomSeeder.php#L18-L25

<!--prettier-ignore-->
> [!NOTE]
> _Password_ untuk masing-masing akun adalah `password`. Lihat di [`UserFactory.php`](https://github.com/rizkyilhampra/spdhtc/blob/master/database/factories/UserFactory.php)

### Email Verification

Saat melakukan registrasi manual dengan pergi ke `/register`, aplikasi akan mengirimkan email yang berisi link/url untuk verifikasi. Secara *default* ketika meng-*copy* *environment file* dari [`.env.example`](./.env.example), Mailer yang digunakan adalah `log` yang berarti email tidak akan terkirim ke alamat email yang didaftarkan, atau hanya dikirim ke dalam log aplikasi saja yaitu di `./storage/logs/laravel.log`. Jika ingin mengubah *behavior* ini atau ingin email terkirim ke alamat email yang didaftarkan, kita perlu mengubah nilai *environment variable* pada *file* `.env`, mulai dari konfigurasi `MAIL_MAILER=` kemudian diikuti dengan konfigurasi lainnya menyesuaikan opsi Mailer yang dipilih. Untuk informasi lebih lengkap beserta Mailer apa saja yang tersedia, dapat di lihat pada [dokumentasi Laravel terkait Mail](https://laravel.com/docs/11.x/mail).

> [!NOTE]
> [SPDHTC](https://spdhtc.rizkyilhampra.me) per versi [v2.2-beta](https://github.com/rizkyilhampra/spdhtc/releases/tag/v2.2-beta) telah membawa [Resend](https://resend.com/) SDK sebagai opsi Mailer di *production* menggantikan `SMTP`, dengan ini kami dapat mengirimkan email yang berisi Email Verification ke seluruh alamat email yang mendaftar di [SPDHTC](https://spdhtc.rizkyilhampra.me). Per rilis [v2.2-beta](https://github.com/rizkyilhampra/spdhtc/releases/tag/v2.2-beta), kami juga mengubah nilai *default* pada [`.env.example`](./.env.example) untuk Mailer menjadi `log` menggantikan `SMTP` dengan host [Mailhog](https://github.com/mailhog/MailHog) untuk Development *phase*. 

## Bantuan & Kontak

Jika Anda menghadapi masalah atau memiliki pertanyaan, Anda dapat:
- Memeriksa diskusi yang sudah ada atau membuat diskusi baru [di sini](https://github.com/rizkyilhampra/spdhtc/discussions?discussions_q=)
- Menghubungi kami melalui [Instagram](https://instagram.com/rizkyilhampra) atau [Email](mailto:rizkyilhamp16@gmail.com)

## Roadmap

- ✅ *Implement scheduled command for RajaOngkir API re-caching*
- ✅ *Allow guests to access Admin Panel*

## Next

*Coming soon:* [SPDPTC](https://github.com/SPDPTC/SPDPTC) - *the next evolution and rebrand of* SPDHTC. 

SPDPTC *brings you:*
- *Decoupled architecture*
- SaaS-*based platform*
- *Modern UI design*
- *Enhanced performance*
- SPA *with reactive components*
- *Comprehensive testing*
- *Open source licensed*

*If you appreciate* SPDHTC *and want to support our next development, please consider* [becoming a sponsor](https://github/sponsors/rizkyilhampra). *For roadmap and more details, check the* [SPDPTC](https://github.com/SPDPTC/SPDPTC) *README file.*

## Lisensi

Lisensi dari proyek/aplikasi ini di bawah [WTFPL](./COPYING).

## Star History

<a href="https://star-history.com/#rizkyilhampra/spdhtc&Timeline">
    <picture>
        <source media="(prefers-color-scheme: dark)" srcset="https://api.star-history.com/svg?repos=rizkyilhampra/spdhtc&type=Timeline&theme=dark" />
        <source media="(prefers-color-scheme: light)" srcset="https://api.star-history.com/svg?repos=rizkyilhampra/spdhtc&type=Timeline" />
        <img alt="Star History Chart" src="https://api.star-history.com/svg?repos=rizkyilhampra/spdhtc&type=Timeline" />
    </picture>
</a>
