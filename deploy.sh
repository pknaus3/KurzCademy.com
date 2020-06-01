#!/bin/sh
echo "Current directory: $(pwm)"
echo "Starting deployment $USER@$(hostname)..."
echo "Pulling git repo..."
git pull
echo "Updating october..."
php artisan october:up
echo "Setting cd to vuetober..."
cd themes/vuetober
pwm
echo "Installing npm..."
npm install
echo "Building app..."
npm run build
