# Persuratan

Persuratan merupakan aplikasi web yang berfungsi untuk mengelola pembuatan surat. Aplikasi ini dibangun dengan memanfaatkan _framework_ Laravel versi 7.29. Aplikasi ini memanfaatkan aplikasi pihak ketiga sebagai _server broadcasting_ bernama Pusher yang berfungsi agar dapat memperbaharui tampilan di pengguna secara _real-time_.

## Apa itu Laravel?

Lumen merupakan _framework_ yang dikembangkan oleh Taylor Otwell. _Framework_ ini menggunakan bahasa PHP.

## Spesifikasi kebutuhan

Karena aplikasi ini menggunakan _framework_ Laravel versi 7.29, maka spesifikasinya mengikuti kebutuhan dari framework itu sendiri. Sila menuju ke laman dokumentasi resminya [di sini](https://laravel.com/docs/7.x).

## Cara menggunakan

1. **_Clone_** repositori ini.
2. Jalankan `composer install`.
3. Jika pada folder tidak terdapat file **.env**, copy file **.env.example** di direktori yang sama kemudian ganti namanya menjadi **.env**.
4. Sesuaikan dengan setup pada komputernya, mulai dari _database_, URL aplikasi, hingga layanan _broadcast_ yang digunakan.

## Ingin memodifikasi sesuai kebutuhan?

Aplikasi ini menggunakan lisensi MIT. Apabila ingin memodifikasi aplikasinya, dipersilahkan. Adapun sebagai bantuan untuk memodifikasinya bisa menggunakan referensi-referensi berikut:

1. [Dokumentasi resmi _framework_ Laravel](https://laravel.com/docs/7.x).
2. [Tutorial menggunakan Pusher di framework Laravel](https://pusher.com/tutorials/realtime-table-laravel).
3. [Tutorial menggunakan Pusher di framework Laravel (**Bahasa Indonesia**)](https://medium.com/@ranggaantok/laravel-pusher-real-time-notification-e8a0012a25c3).
