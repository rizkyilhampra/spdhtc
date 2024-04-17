# Sistem Pakar Deteksi Penyakit pada Tanaman Cabai | SPDHTC
> [!NOTE] 
> Working on progress to make nicer documentation about this web app.

## Sebelum menjalankan aplikasi
Terdapat dua versi algoritma dalam aplikasi ini.
- [v2.1-beta(latest)](https://github.com/rizkyilhampra/spdhtc/releases/tag/v2.1-beta)
  - TL;DR Tidak semua pertanyaann akan tampil, jika jawabannya `tidak` maka akan langsung lompat ke pertanyaan selanjutnya.
- [v1.3](https://github.com/rizkyilhampra/spdhtc/releases/tag/v1.3)
  - TL;DR Semua pertanyaan akan tampil, jika jawabannya `tidak` maka akan tetap menampilkan pertanyaan selanjutnya.

Gunakan salah satu dari dua versi tersebut dan **tidak direkomendasikan** untuk *cloning* langsung dari `master` *branch*. Karena disana terdapat pipeline CI/CD untuk deployment, sehingga terjadi kemungkinan beberapa fitur ter-*disable*.

> [!NOTE]
> Jika menggunakan Git, anda bisa berpindah ke versi yang diinginkan dengan menggunakan perintah `git checkout <tag>`. Contohnya `git checkout v2.1-beta`


## Cara menjalankan aplikasi di local
### Menjalankan dengan `php artisan serve`
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

### Menjalankan dengan web server atau dengan *local development environment* (XAMPP/Laragon)
<details>
    <summary>
        Klik disini untuk melihat
    </summary>

#### Persyaratan
- Git (opsional)
- PHP 8.0 (minimal)
- Composer
- MySQL atau MariaDB
- Web server 

#### Langkah-langkah
1. Masuk ke direktori root dari web server atau *local development environment*
    > Misalnya, untuk XAMPP di Windows, direktori root biasanya berada di `C:\xampp\htdocs` dan untuk Laragon, biasanya berada di `C:\laragon\www`
2. Clone repositori atau download ZIP di [sini](https://github.com/rizkyilhampra/spdhtc/releases) kemudian ekstraksi
    1. Menggunakan Git
        ```bash
        git clone https://github.com/rizkyilhampra/spdhtc.git spdhtc
        ```
3. Masuk ke direktori/folder `spdhtc`
    ```bash
    cd spdhtc
    ```
4. *Checkout* ke versi yang diinginkan (jika menggunakan Git)
    ```bash
    git checkout v3.1-beta
    ```
5. Install dependensi
    ```bash
    composer install
    ```
6. Copy file `.env.example` menjadi `.env`
    ```bash
    cp .env.example .env
    ```
7. Buat *database* baru
    1. Dengan CLI
        ```bash
        mysql -u root -p
        ```
        ```sql
        CREATE DATABASE spdhtc;
        exit;
        ```
8. Konfigurasi *database* pada file `.env`
    ```diff
    DB_CONNECTION=mysql
    DB_HOST=128.0.0.1
    DB_PORT=3307
    - DB_DATABASE=laravel
    + DB_DATABASE=spdhtc
    DB_USERNAME=root #sesuaikan dengan username MySQL
    DB_PASSWORD= #sesuaikan dengan password MySQL (kosongkan jika tidak ada)
    ```
9. Tambahkan Google kredensial pada file `.env` (Opsional)
    > Ini berhubungan dengan fitur login dan register. Mengabaikan ini maka login dan register dengan akun Google tidak akan berjalan.
    ```bash
    # NOTE: dapatkan dari https://console.cloud.google.com
    GOOGLE_CLIENT_ID= #isi dengan client id google
    GOOGLE_CLIENT_SECRET= #isi dengan client secret google
    ```
10. Tambahkan Rajaongkir kredensial pada file `.env` (Opsional dengan [catatan](https://github.com/rizkyilhampra/spdhtc/discussions/71))
    ```bash
    # NOTE: dapatkan dari https://rajaongkir.com/dokumentasi
    RAJAONGKIR_API_KEY= #isi
    ```
11. Generate key aplikasi
    ```bash
    php artisan key:generate
    ```
12. Migrasi *database* dan *seed* data
    ```bash
    php artisan migrate:fresh --seed
    ```
13. Link storage
    ```bash
    php artisan storage:link
    ```
14. Buka browser dan akses `http://localhost/spdhtc/public` atau `http://spdhtc.test/public`

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

## FAQ
- **Q**: Mengapa versi terakhir 2.1 termasuk *beta version*?
    - **A**: Karena beberapa kode dan algoritma untuk mencapai tujuan tersebut, kami rasa kurang sempurna. 

Cek beberapa pertanyaan lainnya atau buat pertanyaan baru jika belum ada, [disini](https://github.com/rizkyilhampra/spdhtc/discussions/categories/q-a)
