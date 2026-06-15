<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->instance('request', Illuminate\Http\Request::create('/'));
$kernel->bootstrap();

$articles = \App\Models\Article::where('is_published', true)
                ->latest()
                ->paginate(9);

echo "Type: " . (is_object($articles) ? get_class($articles) : gettype($articles)) . "\n";
if (is_iterable($articles)) {
    echo "Count: " . count($articles) . "\n";
    foreach ($articles as $index => $item) {
        echo "Item $index type: " . gettype($item) . "\n";
        if (is_object($item)) {
            echo "Item class: " . get_class($item) . "\n";
        }
    }
}
