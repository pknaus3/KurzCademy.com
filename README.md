# KurzCademy
## Ako to rozbehať

1. Naclonovať repo
> Všetky dalšie kroky treba spraviť vo WSL (Ak máš Mac alebo linux tak v terminály)
2. Rozbehať composer
```
composer install
```
3. Rozbehať october
```
touch storage/database.sqlite

php artisan october:up
```
4. Buildnúť Vue aplikáciu
```
cd ./themes/vuetober
npm install
npm run build
```

## Spustenie pre vývojárov
1. Spustiť php
```
php artisan serve
```
2. Spustiť Vue
```
cd ./themes/vuetober
npm run serve
```
> Aj php aj Vue musia bežať naraz!

> V BE musíte zmeniť aktívnu tému na "Vuetober"
3. Otvoriť v prehliadači [localhost:8000](http://localhost:8000)
