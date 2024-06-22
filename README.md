# SPDHTC
> [!NOTE]
> Dokumentasi ini masih belum lengkap dan akan terus di-*update*

Sistem pakar atau sistem pengambilan keputusan untuk mendeteksi atau mendiagnosis penyakit yang menyerang tanaman cabai. Sistem ini menggunakan algoritma *forward chaining* sebagai metode inteferensi. Data yang digunakan dalam proses diagnosis bersumber dari sebuah instansi pemerintah dan berdasarkan jurnal jurnal resmi.

## Teknologi yang digunakan
- Laravel 9
- JQuery
- Bootstrap 5
- dan beberapa *library* lainnya

## Sebelum menjalankan aplikasi di local
Terdapat dua versi algoritma dalam aplikasi ini.
- [v2.1-beta(latest)](https://github.com/rizkyilhampra/spdhtc/releases/tag/v2.1-beta)
  - TL;DR Tidak semua pertanyaann akan tampil, jika jawabannya `tidak` maka akan langsung lompat ke pertanyaan selanjutnya.
- [v1.3](https://github.com/rizkyilhampra/spdhtc/releases/tag/v1.3)
  - TL;DR Semua pertanyaan akan tampil, jika jawabannya `tidak` maka akan tetap menampilkan pertanyaan selanjutnya.

> [!WARNING]
> Gunakan salah satu dari dua versi tersebut dan **tidak direkomendasikan** untuk *cloning* langsung dari `master` *branch*. Karena disana terdapat pipeline CI/CD untuk deployment, sehingga terjadi kemungkinan beberapa fitur ter-*disable*. Lihat juga bagian [FAQ terkait beta version](#faq)

> [!NOTE]
> Jika menggunakan Git, anda bisa berpindah ke versi yang diinginkan dengan menggunakan perintah `git checkout <tag>`. Contohnya `git checkout v2.1-beta`


## Cara menjalankan aplikasi di local
### Menjalankan dengan web server atau dengan *local development environment* (XAMPP/Laragon)
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
4. *Checkout* ke versi yang diinginkan
    > Abaikan langkah ini, jika memilih *download* ZIP
    1. Menggunakan Git untuk *checkout* ke versi 2.1-beta
        ```bash
        git checkout v2.1-beta
        ```
    2. Menggunakan Git untuk *checkout* ke versi 1.3
        ```bash
        git checkout v1.3
        ```

5. Install dependensi
    > Pastikan PHP dan Composer sudah terinstall!
    ```bash
    composer install
    ```
6. *Copy file* `.env.example` kemudian *paste* di tempat yang sama, lalu ubah nama *file* menjadi `.env`
    1. Menggunakan CLI berbasis Unix
        ```bash
        cp .env.example .env
        ```
7. Buat *database* baru
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
8. Konfigurasi *database* pada file `.env`
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
9. Tambahkan Google kredensial (Opsional)
    > Ini berhubungan dengan fitur login dan register. Mengabaikan ini maka login dan register dengan akun Google tidak akan berjalan.
    ```bash
    # NOTE: dapatkan dari https://console.cloud.google.com
    GOOGLE_CLIENT_ID= #isi dengan client id google
    GOOGLE_CLIENT_SECRET= #isi dengan client secret google
    ```
10. Tambahkan Rajaongkir kredensial (Opsional dengan [**catatan**](https://github.com/rizkyilhampra/spdhtc/discussions/71))
    ```bash
    # NOTE: dapatkan dari https://rajaongkir.com/dokumentasi
    RAJAONGKIR_API_KEY= #isi
    ```
11. *Generate key* aplikasi
    > Jalankan melalui terminal
    ```bash
    php artisan key:generate
    ```
12. Migrasi *database* dan *seed* data
    ```bash
    php artisan migrate:fresh --seed
    ```
13. *Link storage*
    > Ini berfungsi untuk mengakses file yang ada di direktori `storage/app/public`  atau dalam kata lain untuk menampilkan gambar penyakit
    ```bash
    php artisan storage:link
    ```
14. Buka browser dan akses `http://localhost/spdhtc/public` atau `http://spdhtc.test`

### Menjalankan dengan `php artisan serve`
<details>
    <summary>
        Klik disini untuk melihat
    </summary>

#### Persyaratan 
- Git (opsional)
- PHP 8.0 (minimal)
- Composer
- MySQL atau MariaDB

#### Langkah-langkah
1. Clone repositori atau download ZIP di [sini](https://github.com/rizkyilhampra/spdhtc/releases) kemudian ekstraksi
    1. Menggunakan Git
        ```bash
        git clone https://github.com/rizkyilhampra/spdhtc.git spdhtc
        ```
2. Masuk ke direktori/folder `spdhtc`
    ```bash
    cd spdhtc
    ```
3. *Checkout* ke versi yang diinginkan (jika menggunakan Git)
    ```bash
    git checkout v2.1-beta
    ```
4. Install dependensi
    ```bash
    composer install
    ```
5. Copy file `.env.example` menjadi `.env`
    ```bash
    cp .env.example .env
    ```
    atau di windows (powershell)
    ```powershell
    Copy-Item .env.example .env
    ```
6. Buat *database* baru
    1. Dengan CLI
        ```bash
        mysql -u root -p
        ```
        ```sql
        CREATE DATABASE spdhtc;
        exit;
        ```
7. Konfigurasi *database* pada file `.env`
    ```diff
    DB_CONNECTION=mysql
    DB_HOST=128.0.0.1
    DB_PORT=3307
    - DB_DATABASE=laravel
    + DB_DATABASE=spdhtc
    DB_USERNAME=root #sesuaikan dengan username MySQL
    DB_PASSWORD= #sesuaikan dengan password MySQL (kosongkan jika tidak ada)
    ```
8. Tambahkan Google kredensial pada file `.env` (Opsional)
    > Ini akan berhubungan dengan fitur login dan register. Mengabaikan ini maka login dan register dengan akun Google tidak akan berjalan.
    ```bash
    # NOTE: dapatkan dari https://console.cloud.google.com
    GOOGLE_CLIENT_ID= #isi dengan client id google
    GOOGLE_CLIENT_SECRET= #isi dengan client secret google
    ```
9. Tambahkan Rajaongkir kredensial pada file `.env` (Opsional dengan [catatan](https://github.com/rizkyilhampra/spdhtc/discussions/71))
    ```bash
    # NOTE: dapatkan dari https://rajaongkir.com/dokumentasi
    RAJAONGKIR_API_KEY= #isi
    ```
10. Generate key aplikasi
    ```bash
    php artisan key:generate
    ```
11. Migrasi *database* dan *seed* data
    ```bash
    php artisan migrate:fresh --seed
    ```
12. Link storage
    ```bash
    php artisan storage:link
    ```
13. Jalankan aplikasi
    ```bash
    php artisan serve
    ```
14. Buka browser dan akses `http://localhost:8000`

</details>

### Menjalankan dengan Docker/Sail
> [!NOTE]
> Hanya tersedia di versi v2.1-beta ke atas

<details>
    <summary>
        Klik disini untuk melihat
    </summary>

#### Persyaratan
- Git (opsional)
- Docker Desktop (Windows/Mac) atau Docker Engine (Linux)

#### Langkah-langkah
1. Clone repositori atau download ZIP di [sini](https://github.com/rizkyilhampra/spdhtc/releases) kemudian ekstraksi
    1. Menggunakan Git
        ```bash
        git clone https://github.com/rizkyilhampra/spdhtc.git spdhtc
        ```
2. Masuk ke direktori/folder `spdhtc`
    ```bash
    cd spdhtc
    ```
3. *Checkout* ke versi yang diinginkan (jika menggunakan Git)
    ```bash
    git checkout v2.1-beta
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
Secara default saat *seeding* data, akan membawa 2 akun pengguna yang telah terdaftar di dalam aplikasi. Sehingga untuk dapat login ke dalam aplikasi, dapat menggunakan data akun berikut.

https://github.com/rizkyilhampra/spdhtc/blob/15a0ce9725473d6682703894bcd1e999ef15fd93/database/seeders/UserCustomSeeder.php#L43-L57

## FAQ
- **Q**: Mengapa versi terakhir 2.1 termasuk *beta version*?
    - **A**: Karena beberapa kode dan algoritma untuk mencapai tujuan tersebut, kami rasa kurang sempurna. 

Cek beberapa pertanyaan lainnya atau buat pertanyaan baru jika belum ada, [disini](https://github.com/rizkyilhampra/spdhtc/discussions/categories/q-a)
