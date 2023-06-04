## Tentang Aplikasi
    Sebuah website untuk Angkatan di SMA yang bernama Dersik 22, berisi pendataan alumni, e-voting, dan informasi tentang Angkatan.

## Fitur Aplikasi
    -Register dan Login
    -Halaman berdasar role
    -Pemilihan(e-voting)
    -Informasi Terbaru
    -Pendataan Siswa
    -Database kelas, angkatan, koordinator perwilayah

## Cara run
    Lakukan Composer Install
    Copy .env.example ke .env
    Lakukan php artisan key:generate
    Buat database
    Lakukan php artisan migrate --seed
    Lakukan php artisan serve
    default user = admin password = password
