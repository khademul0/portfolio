<?php
/**
 * Patch all Filament Resource files to disable the confirmation modal on delete actions.
 * This bypasses the Alpine $refs.modalContainer crash in Filament 3.2 + Livewire 3.
 */
$resDir = __DIR__ . '/app/Filament/Resources';
$files = glob($resDir . '/*Resource.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    $changed = false;

    // Fix row-level DeleteAction - add ->requiresConfirmation(false)
    if (str_contains($content, "Tables\\Actions\\DeleteAction::make()") &&
        !str_contains($content, "DeleteAction::make()\n                ->requiresConfirmation(false)")) {
        $content = str_replace(
            "Tables\\Actions\\DeleteAction::make(),",
            "Tables\\Actions\\DeleteAction::make()\n                ->requiresConfirmation(false),",
            $content
        );
        $changed = true;
    }

    // Fix bulk DeleteBulkAction - add ->requiresConfirmation(false)
    if (str_contains($content, "Tables\\Actions\\DeleteBulkAction::make()") &&
        !str_contains($content, "DeleteBulkAction::make()\n                    ->requiresConfirmation(false)")) {
        $content = str_replace(
            "Tables\\Actions\\DeleteBulkAction::make(),",
            "Tables\\Actions\\DeleteBulkAction::make()\n                    ->requiresConfirmation(false),",
            $content
        );
        $changed = true;
    }

    if ($changed) {
        file_put_contents($file, $content);
        echo "Patched: " . basename($file) . "\n";
    } else {
        echo "Skipped (already patched or no match): " . basename($file) . "\n";
    }
}

// Also fix Header DeleteAction on Edit pages
$editPages = glob($resDir . '/*/Pages/Edit*.php');
foreach ($editPages as $file) {
    $content = file_get_contents($file);
    if (str_contains($content, "Actions\\DeleteAction::make()") &&
        !str_contains($content, "Actions\\DeleteAction::make()\n            ->requiresConfirmation(false)")) {
        $content = str_replace(
            "Actions\\DeleteAction::make(),",
            "Actions\\DeleteAction::make()\n            ->requiresConfirmation(false),",
            $content
        );
        file_put_contents($file, $content);
        echo "Patched Edit page: " . basename($file) . "\n";
    }
}

echo "\nAll done!\n";
