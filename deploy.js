import { execSync } from 'child_process';
import fs from 'fs';
import path from 'path';

// Load configurations from .deploy.json
let config = {
    repoPath: '/home/genesisindo/git/genesis-indonesia',
    publicHtmlPath: '/home/genesisindo/public_html',
    branch: 'main'
};

const configPath = path.resolve('./.deploy.json');
if (fs.existsSync(configPath)) {
    try {
        config = JSON.parse(fs.readFileSync(configPath, 'utf-8'));
        console.log('📖 Loaded configuration from .deploy.json');
    } catch (error) {
        console.error('⚠️ Warning: Failed to parse .deploy.json, using defaults.');
    }
} else {
    console.log('ℹ️ .deploy.json not found, using default configuration.');
}

const repoPath = config.repoPath;
const publicHtmlPath = config.publicHtmlPath;
const branch = config.branch || 'main';
const publicFolder = path.join(repoPath, 'public');

function runCmd(command, cwd = repoPath) {
    console.log(`\nExecuting: ${command}`);
    try {
        execSync(command, { cwd, stdio: 'inherit' });
    } catch (error) {
        console.error(`Error executing: ${command}`);
        console.error(error.message);
        process.exit(1);
    }
}

console.log('🚀 Starting Deployment...');

// 1. Pull latest code
runCmd(`git pull origin ${branch}`);

// 2. Install PHP dependencies
runCmd('composer install --no-dev --optimize-autoloader');

// 3. Install JS dependencies
runCmd('npm install');

// 4. Build frontend assets
runCmd('npm run build');

// 5. Run database migrations
runCmd('php artisan migrate --force');

// 6. Clear and optimize Laravel caches
runCmd('php artisan optimize');

// 7. Handle Symlink for public_html
console.log('\nSetting up public_html symlink...');
if (fs.existsSync(publicHtmlPath)) {
    const stats = fs.lstatSync(publicHtmlPath);
    if (stats.isSymbolicLink()) {
        console.log('public_html is already a symlink.');
    } else {
        console.log(`Warning: ${publicHtmlPath} is a physical directory.`);
        console.log('Backing up existing public_html to public_html_backup...');
        
        const backupPath = `${publicHtmlPath}_backup_${Date.now()}`;
        fs.renameSync(publicHtmlPath, backupPath);
        
        console.log(`Creating symlink: ${publicHtmlPath} -> ${publicFolder}`);
        fs.symlinkSync(publicFolder, publicHtmlPath);
    }
} else {
    console.log(`Creating symlink: ${publicHtmlPath} -> ${publicFolder}`);
    fs.symlinkSync(publicFolder, publicHtmlPath);
}

console.log('\n✨ Deployment successfully completed!');
