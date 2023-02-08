## Persyaratan

Persyaratan untuk menggunakan YII 2:
- PHP versi 5 keatas
- Composer
- Web server: XAMPP/LARAGON dll 

## Instalasi

Untuk memulai menggunakan YII 2 Advanced, silahkan gunakan composer untuk menginstalnya di komputer Anda.

```
composer create-project --prefer-dist yiisoft/yii2-app-advanced <nama projek>
```

Setelah melakukan penginstalan YII 2, masukkan perintah dibawah pada CMD untuk mengenerate file yang diperlukan pada saat Development atau Production.

```
php init
```

Secara default hanya terdapat Development dan Production namun bisa ditambahkan sesuai keinginan tapi dengan catatan harus melakukan konfirgurasi terlebih dahulu. 

## Install Kartik Widget

Ekstension ini untuk mempermudahkan dalam development.

```
composer require kartik-v/yii2-widgets "*"
```

## Install Gii

Gii sebagai Generator pada YII 2, ada banyak fungsi GII seperti membuat Model, Controller, CRUD dll

```
composer require --dev --prefer-dist yiisoft/yii2-gii
```

## Install Mimin

Extension ini berfungsi sebagai authentication ke database

```
composer require --prefer-dist hscstudio/yii2-mimin "~1.1.5"
```