<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tentang Mymarket

Ini adalah aplikasi berbasis web untuk latihan marketplace dan tidak ditujukan untuk produksi, hanya latihan atau sekedar crud marketplace:

- Halaman admin: master data
- Halaman toko : produk dan transaksi
- Halaman user: beli, keranjang dan transaksi

## Installasi

- git clone
- copy .env.example dan rename menjadi .env
- Buat database kosong dengan nama mymarket
- jalankan di terminal: composer install
- jalankan di terminal: php artisan key:generate
- jalankan di terminal: php artisan migrate:fresh --seed
- jalankan di terminal: php artisan serve

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
