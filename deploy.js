import { execSync } from 'child_process';
import fs from 'fs';
import path from 'path';

// Load configurations from .deploy.json
let config = {
    repoPath: '/home/genesisindonesia/htdocs/genesisindonesia.com',
    publicHtmlPath: '/home/genesisindonesia/htdocs/genesisindonesia.com/public',
    branch: 'main',
    phpPath: 'php'
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
const phpCmd = config.phpPath || 'php';
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
console.log(`Using PHP command: ${phpCmd}`);

// 1. Pull latest code
runCmd(`git pull origin ${branch}`);

// 2. Check and run Composer
let composerCmd = 'composer';
if (phpCmd !== 'php') {
    console.log('Checking for local composer.phar...');
    if (!fs.existsSync(path.join(repoPath, 'composer.phar'))) {
        console.log('Downloading composer.phar...');
        runCmd(`curl -sS https://getcomposer.org/installer | ${phpCmd}`);
    }
    composerCmd = `${phpCmd} composer.phar`;
} else {
    try {
        execSync('command -v composer');
    } catch (e) {
        console.log('⚠️ composer command not found globally. Checking for local composer.phar...');
        if (!fs.existsSync(path.join(repoPath, 'composer.phar'))) {
            console.log('Downloading composer.phar...');
            runCmd(`curl -sS https://getcomposer.org/installer | ${phpCmd}`);
        }
        composerCmd = `${phpCmd} composer.phar`;
    }
}

runCmd(`${composerCmd} install --no-dev --optimize-autoloader`);

// 3. Check and run NPM/Vite Build
let hasNpm = false;
try {
    execSync('command -v npm');
    hasNpm = true;
} catch (e) {
    console.log('⚠️ Warning: npm command not found on the server. Skipping npm build.');
    console.log('Note: If Node/NPM is not installed, please build the assets locally (npm run build) and push the \'public/build\' folder to GitHub.');
}

if (hasNpm) {
    runCmd('npm install');
    runCmd('npm run build');
}

// 4. Run database migrations
runCmd(`${phpCmd} artisan migrate --force`);

// 5. Clear and optimize Laravel caches
runCmd(`${phpCmd} artisan optimize`);

// 5b. Ensure storage symbolic link exists
runCmd(`${phpCmd} artisan storage:link --force`);

// 5c. Publish Livewire assets to disk to prevent Nginx 404 block
runCmd(`${phpCmd} artisan livewire:publish --assets --force`);

// 6. Handle Symlink for public_html
if (publicHtmlPath && publicHtmlPath !== publicFolder) {
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
} else {
    console.log('\nSkipping symlink since public path matches repo public directory directly.');
}

console.log('\n✨ Deployment successfully completed!');
