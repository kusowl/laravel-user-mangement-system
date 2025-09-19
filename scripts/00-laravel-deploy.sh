#!/usr/bin/env bash
echo "Linking storage"
php artisan storage:link
echo "Caching config..."
php artisan config:cache
echo "Caching routes..."
php artisan route:cache
