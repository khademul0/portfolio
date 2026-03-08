<?php
/**
 * Patch all Filament Resource files to redirect/refresh after delete.
 */
$resDir = __DIR__ . '/app/Filament/Resources';
$files = glob($resDir . '/*Resource.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    $changed = false;

    // Patch row-level delete to reload after
    $old = "->action(fn (\$record) => \$record->delete()),";
    $new  = "->action(function (\$record, \$livewire) {\n                    \$record->delete();\n                    \$livewire->redirect(request()->header('Referer') ?: url()->current());\n                }),";
    if (str_contains($content, $old)) {
        $content = str_replace($old, $new, $content);
        $changed = true;
    }

    // Patch bulk delete to reload after
    $oldBulk = "->action(fn (\$records) => \$records->each->delete()),";
    $newBulk  = "->action(function (\$records, \$livewire) {\n                    \$records->each->delete();\n                    \$livewire->redirect(request()->header('Referer') ?: url()->current());\n                }),";
    if (str_contains($content, $oldBulk)) {
        $content = str_replace($oldBulk, $newBulk, $content);
        $changed = true;
    }

    if ($changed) {
        file_put_contents($file, $content);
        echo "Patched redirect: " . basename($file) . "\n";
    } else {
        echo "Skipped: " . basename($file) . "\n";
    }
}

echo "Done!\n";
