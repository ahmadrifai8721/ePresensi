
![Logo](https://komando.cloud/dist/images/ksof.png)


# E-PRESENSI V 1.0

APLIKASI YANG DI KEMBANGKAN OLEH KSOFT UNTUK ABSENSI SISWA SEKOLAH YANG SUDAH TERKONEKSI LANGSUNG DENGAN DAPODIK
## Deployment

To deploy this project run

```bash
  git clone gh repo clone https://github.com/ahmadrifai8721/ePresensi.git
```

```bash
  composer install
```
```bash
  cp .env.example .env
```
```bash
  cp .env.example .env
```
```bash
php artisan env:decrypt --cipher AES-256-CBC --key <Inset Key>
```

Please Contact Developer to get Key


## Edit Database And Dapodik Webservice in .env file

### Database Connection
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<Insert Database Name>
DB_USERNAME=<Insert Database Username>
DB_PASSWORD=<Insert Database Password>
```

### Dapodik WebService Config
```bash
DAPODIK_SERVER_IP=<Dapodik Server Address>
DAPODIK_SERVER_PORT=<Port Dapodik>
DAPODIK_SERVER_NPSN=<School NPSN>
DAPODIK_SERVER_Token=<Token Webservice>
```
## Installation

To Installation Visite

```bash
 <Your Server Address>/install
```

Ans Fill in the form with the Dapodik admin account
    