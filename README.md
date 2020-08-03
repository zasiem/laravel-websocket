# Laravel web-socket
repository to implement websocket using laravel

## How to install
pastikan sudah terinstall php 7 dan dbms (mysql)

### Instalation Step
1. clone this repository `git clone`
2. setting `.env` (lihat sub judul bawah)
3. install composer menggunakan : `composer install`
4. install npm dependency menggunakan :`npm install`
5. run npm dependency : `npm run dev`
6. migrate database : `php artisan migrate`
7. generate key untuk env : `php artisan key:generate`
8. serve artisan server : `php artisan serve`
9. serve websockets server : `php artisan websockets:serve`

### Setting .env
1. Setting database sesuai dengan dbms
2. Pastikan drivernya menggunakan pusher : `BROADCAST_DRIVER=pusher`
3. Pastikan pusher env sudah terisi : <br>
`PUSHER_APP_ID=myid` <br>
`PUSHER_APP_KEY=mykey` <br>
`PUSHER_APP_SECRET=mysecret` <br>
`PUSHER_APP_CLUSTER=mt1`

## Deliverables
1. global chat (done)
2. private chat (fixing bugs)
3. api private chat
