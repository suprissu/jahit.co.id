<h1 align="center">JAHIT.CO.ID</h1>
<p align="center"><a href="">https://jahit.co.id</a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>

## About JAHIT.CO.ID

JAHIT.CO.ID lahir pada tahun 2020 di era pandemic COVID 19, Kami mempunyai semangat untuk meningkatkan Industri textile dan fashion dalam negeri. Kami membantu para penjahit yang sudah kami verifikasi menjadi bagian dari partner kami untuk mendapatkan customer lebih luas dan lebih cepat melalui platform kami. Pelanggan akan langsung mendapatkan balasan dari jaringan penjahit kami lebih cepat mudah dan terjangkau.

## Tech Stack

Proyek ini menggunakan beberapa library dan framework sebagai berikut:

- [Laravel 5.8](https://laravel.com/docs/).
- HTML, CSS, Javascript.
- [Bootstrap  4.1](https://getbootstrap.com/docs/).
- [jQuery 3.3.1](https://api.jquery.com/).
- [Font Awesome 5](https://fontawesome.com/).
- [Google Fonts](https://fonts.google.com/).
- [Faker 1.4](https://github.com/fzaninotto/Faker/).
- [Image Intervention 2.5](http://image.intervention.io/).
- [MySQL](https://www.mysql.com/).

## Set Up Project

Cara setup project pertama kali dengan menggunakan **[Laragon](https://laragon.org/)**:

### 1. Clone project
```sh
git clone https://gitlab.com/dhafins18/jahit
```

### 2. Install dependencies
```sh
composer install
```

### 3. Make `.env` file
```sh
cp .env.example .env
```

### 4. Generate API Key to `.env`
```sh
php artisan key:generate
```

### 5. Create database via **Laragon**
by clicking *Database->Open->Laragon (Right Click)->Create New->Database->Fill Database Name (will be used for `DB_DATABASE` value in `.env`)->OK*

### 6. Set Up `.env`
by filling DB properties (via Laragon Database for `DB_USERNAME` and `DB_PASSWORD`)
```env
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### 7. Migrate and Seed Database
```sh
php artisan migrate:refresh --seed
```

### 8. Run project
```sh
php artisan serve
```

## Pull Changes

Untuk melakukan meng-update project di local, cukup lakukan langkah berikut

### 1. Install new dependencies *(if there are some changes in `composer.json`)*
```sh
composer install
```

### 2. Migrate and Seed *(if there are some changes in Migrations or Seeders)*
```sh
php artisan migrate:refresh --seed
```

### 3. Run project
```sh
php artisan serve
```

### 4. Refresh cache *(if some files can't be detected by php)*
```sh
composer dump-autoload
```

## Developers

Anggota tim developer:

- **Ahmad Supriyanto** (Front-end & UI/UX)
- **Razaqa Dhafin** (Back-end & Devops) -> *visit [razaaf.tech](https://razaaf.tech/#work) to see my works and contact me via [razaaf.tech](https://razaaf.tech/#contact) or [dhafins99@hotmail.com](mailto:dhafins99@hotmail.com)!*

## License

 2020 © All right Reversed.
