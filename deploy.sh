#!/bin/bash

# Exit immediately if a command exits with a non-zero status
set -e

# Default values if .deploy.json parser fails
REPO_PATH="/home/genesisindonesia/htdocs/genesisindonesia.com"
PUBLIC_HTML="/home/genesisindonesia/htdocs/genesisindonesia.com/public"
BRANCH="main"
PHP_CMD="php"

# Parse .deploy.json if it exists
if [ -f ".deploy.json" ]; then
    echo "📖 Loading configuration from .deploy.json..."
    REPO_PATH=$(grep -o '"repoPath": "[^"]*' .deploy.json | grep -o '[^"]*$' || echo "$REPO_PATH")
    PUBLIC_HTML=$(grep -o '"publicHtmlPath": "[^"]*' .deploy.json | grep -o '[^"]*$' || echo "$PUBLIC_HTML")
    BRANCH=$(grep -o '"branch": "[^"]*' .deploy.json | grep -o '[^"]*$' || echo "$BRANCH")
    PHP_CMD=$(grep -o '"phpPath": "[^"]*' .deploy.json | grep -o '[^"]*$' || echo "$PHP_CMD")
fi

echo "🚀 Starting Deployment in $REPO_PATH..."
echo "Using PHP command: $PHP_CMD"

cd "$REPO_PATH"

# 1. Pull latest code
echo "Pulling latest changes from Git (branch: $BRANCH)..."
git pull origin "$BRANCH"

# 2. Check and run Composer
if command -v composer >/dev/null 2>&1 && [ "$PHP_CMD" = "php" ]; then
    COMPOSER_CMD="composer"
else
    echo "Checking for composer.phar locally..."
    if [ ! -f "composer.phar" ]; then
        echo "Downloading composer.phar..."
        curl -sS https://getcomposer.org/installer | $PHP_CMD
    fi
    COMPOSER_CMD="$PHP_CMD composer.phar"
fi

echo "Installing Composer dependencies..."
$COMPOSER_CMD install --no-dev --optimize-autoloader

# 3. Check and run NPM/Vite Build
if command -v npm >/dev/null 2>&1; then
    echo "Installing NPM dependencies and building assets..."
    npm install
    npm run build
else
    echo "⚠️ Warning: npm command not found on the server. Skipping npm build."
    echo "Note: If Node/NPM is not installed, please build the assets locally (npm run build) and push the 'public/build' folder to GitHub."
fi

# 4. Run Laravel migrations
echo "Running database migrations..."
$PHP_CMD artisan migrate --force

# 5. Optimize Laravel caches
echo "Optimizing Laravel configuration and routes..."
$PHP_CMD artisan optimize

# 5b. Ensure storage symbolic link exists
echo "Recreating storage symbolic link..."
$PHP_CMD artisan storage:link --force

# 5c. Publish Livewire assets to disk to prevent Nginx 404 block
echo "Publishing Livewire assets to public directory..."
$PHP_CMD artisan livewire:publish --assets

# 6. Set up the public_html symlink if applicable
if [ "$PUBLIC_HTML" != "$REPO_PATH/public" ] && [ -n "$PUBLIC_HTML" ]; then
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
else
    echo "Skipping symlink since public path matches repo public directory directly."
fi

echo "✨ Deployment successfully completed!"
