"#!/bin/bash

echo \"🚀 Laravel Company Profile CMS - Quick Setup\"
echo \"==========================================\"

# Check if .env exists
if [ ! -f .env ]; then
    echo \"📋 Creating .env file...\"
    cp .env.example .env
    php artisan key:generate
else
    echo \"✅ .env file already exists\"\nfi

# Install dependencies
echo \"📦 Installing dependencies...\"
composer install --no-interaction
npm install --no-interaction

# Database migrations
echo \"🗄️  Running database migrations...\"
php artisan migrate --force

# Create storage link
echo \"🔗 Creating storage link...\"
php artisan storage:link

# Seed database
echo \"🌱 Seeding database...\"
php artisan db:seed --force

# Build assets
echo \"🎨 Building frontend assets...\"
npm run build

# Set permissions
echo \"🔐 Setting permissions...\"
chmod -R 755 storage bootstrap/cache

echo \"\"
echo \"✨ Setup Complete! ✨\"\necho \"====================\"
echo \"\n📝 Login Credentials:\"
echo \"  Admin Email: admin@example.com\"\necho \"  Admin Password: password\"\necho \"\n  User Email: user@example.com\"\necho \"  User Password: password\"\necho \"\"\echo \"🌐 Access Points:\"\necho \"  Frontend: http://localhost:8000\"\necho \"  Admin:   http://localhost:8000/admin\"\necho \"\"\echo \"🔐 IMPORTANT: Change default passwords immediately!\"\necho \"\"\echo \"To start the development server, run:\"\echo \"  php artisan serve\""