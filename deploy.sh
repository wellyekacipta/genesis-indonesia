#!/bin/bash

# Exit immediately if a command exits with a non-zero status
set -e

REPO_PATH="/home/genesisindo/git/genesis-indonesia"
PUBLIC_HTML="/home/genesisindo/public_html"

echo "🚀 Starting Deployment in $REPO_PATH..."

cd "$REPO_PATH"

# 1. Pull latest code
echo "Pulling latest changes from Git..."
git pull origin main

# 2. Install Composer dependencies
echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

# 3. Install NPM dependencies & build assets
echo "Installing NPM dependencies and building assets..."
npm install
npm run build

# 4. Run Laravel migrations
echo "Running database migrations..."
php artisan migrate --force

# 5. Optimize Laravel caches
echo "Optimizing Laravel configuration and routes..."
php artisan optimize

# 6. Set up the public_html symlink
echo "Configuring public_html symlink..."
if [ -L "$PUBLIC_HTML" ]; then
    echo "public_html is already a symlink."
elif [ -d "$PUBLIC_HTML" ]; then
    echo "Warning: $PUBLIC_HTML is a physical directory."
    BACKUP_PATH="${PUBLIC_HTML}_backup_$(date +%s)"
    echo "Backing up existing directory to $BACKUP_PATH..."
    mv "$PUBLIC_HTML" "$BACKUP_PATH"
    echo "Creating symlink to $REPO_PATH/public..."
    ln -s "$REPO_PATH/public" "$PUBLIC_HTML"
else
    echo "Creating symlink to $REPO_PATH/public..."
    ln -s "$REPO_PATH/public" "$PUBLIC_HTML"
fi

echo "✨ Deployment successfully completed!"
