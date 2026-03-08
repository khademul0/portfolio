<?php
$resDir = __DIR__ . '/app/Filament/Resources';

// 1. Fix missing Delete Action on individual rows
$resources = glob($resDir . '/*Resource.php');
foreach ($resources as $file) {
    $content = file_get_contents($file);
    if (!str_contains($content, 'DeleteAction::make()') && str_contains($content, 'Tables\Actions\EditAction::make()')) {
        $content = preg_replace(
            "/(->actions\(\[\s+Tables\\\Actions\\\EditAction::make\(\),)/",
            "$1\n                Tables\Actions\DeleteAction::make(),",
            $content
        );
        file_put_contents($file, $content);
        echo "Patched actions in " . basename($file) . "\n";
    }
}

// 2. Fix Redirects on Create/Edit
function fixPages($pattern) {
    global $resDir;
    $directories = glob($resDir . '/*', GLOB_ONLYDIR);
    $redirectCode = "\n    protected function getRedirectUrl(): string\n    {\n        return \$this->getResource()::getUrl('index');\n    }\n";
    
    foreach ($directories as $dir) {
        $pages = glob($dir . '/Pages/' . $pattern . '.php');
        foreach ($pages as $file) {
            $content = file_get_contents($file);
            if (!str_contains($content, 'getRedirectUrl')) {
                $content = preg_replace(
                    "/(class\s+\w+\s+extends\s+\w+\n\{)/",
                    "$1" . $redirectCode,
                    $content
                );
                file_put_contents($file, $content);
                echo "Patched redirects in " . basename($dir) . "/" . basename($file) . "\n";
            }
        }
    }
}
fixPages('Create*');
fixPages('Edit*');
echo "Done.\n";
