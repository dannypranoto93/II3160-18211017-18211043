Bagian source code yang dimodifikasi terdapat dalam 3 folder, yaitu :

1. ./application/controllers

Disini terdapat 2 file php utama :
	
a. Api.php -> berisi fungsi-fungsi untuk melakukan konversi data dari
 csv, sql ke array dan dari xml ke array
	
b. Main.php -> berisi fungsi-fungsi untuk mengatur jalannya interface webpage pada website

2. ./application/libraries
Disini terdapat 2 file php utama :
	
a. REST_Controller -> merupakan library REST yang sudah ada, fungsi yang
 digunakan adalah fungsi response yang berfungsi
 untuk menghubungkan Api.php ke dalam Format.php
	
b. Format.php -> berisi fungsi-fungsi untuk melakukan konversi data dari array
 ke dalam bentuk xml dan html sesuai dengan perintah fungsi dari Api.php

3. ./application/views
File-file php pada folder ini digunakan untuk mengatur tampilan pada 
4. ./database_collection -> berisi data-data dalam format sql, xml, dan csv