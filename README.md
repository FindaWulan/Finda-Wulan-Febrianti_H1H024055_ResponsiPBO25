# PokéCare Training System

## Data Diri
Nama: Finda Wulan Febrianti
NIM: H1H024055
Shift Awal: B
Shift Akhir: C

## Deskripsi Aplikasi
PokéCare Training System adalah aplikasi web berbasis PHP native untuk mengelola pelatihan Pokémon bernama Vulpix. Aplikasi menampilkan informasi Pokémon, melakukan berbagai jenis pelatihan, dan mencatat riwayat lengkap setiap sesi latihan.

Pokémon Vulpix:
- Tipe: Fire
- Level Awal: 5
- HP Awal: 95
- Jurus Spesial: Ember, Quick Attack

## Konsep OOP yang Diterapkan
1. Encapsulation: Menggunakan protected properties dan getter/setter methods
2. Inheritance: Class PokeCare mewarisi dari class Pokemon
3. Polymorphism: Implementasi abstract methods train() dan specialMove()
4. Abstraction: Class Pokemon adalah abstract class

## Struktur Project
```
PokeCare/
├── classes/
│   ├── Pokemon.php
│   └── PokeCare.php
├── pages/
│   ├── training.php
│   └── history.php
├── api/
│   └── train.php
├── assets/
│   └── style.css
│   └── vulpix.png
├── index.php
└── README.md
```

## Fitur Aplikasi
- Halaman Beranda: Menampilkan info Pokémon (nama, tipe, level, HP, jurus spesial)
- Halaman Latihan: Form untuk memilih jenis latihan dan intensitas
- Halaman Riwayat: Tabel riwayat lengkap dengan detail level, HP, dan waktu

## Mekanik Pelatihan
Jenis latihan: Attack, Defense, Speed, Stamina
Intensitas: 1-1000 

![ScreenRecording2025-11-29115225-ezgif com-video-to-gif-converter](https://github.com/user-attachments/assets/06cb048f-7b47-4050-beb4-f7ace6a6fbf4)
