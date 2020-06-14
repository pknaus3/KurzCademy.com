# KurzCademy
## Ako to rozbehať

1. Naclonovať repo
> Všetky dalšie kroky treba spraviť vo wsl
2. Rozbehať composer
```
composer install
```
3. Rozbehať october
```
php artisan october:install
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
3. Otvoriť v prehliadači [localhost:8000](http://localhost:8000)
