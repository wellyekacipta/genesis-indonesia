import { execSync } from 'child_process';
import fs from 'fs';
import path from 'path';

// Configurations
const repoPath = '/home/genesisindo/git/genesis-indonesia';
const publicHtmlPath = '/home/genesisindo/public_html';
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
runCmd('git pull origin main'); // or change to your branch name if different

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
