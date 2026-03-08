<?php
/**
 * Patch all Filament Resource files to make delete actions use a direct closure
 * instead of the Livewire-Alpine confirmation modal pipeline.
 */
$resDir = __DIR__ . '/app/Filament/Resources';
$files = glob($resDir . '/*Resource.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    $changed = false;

    // Replace row-level delete with a direct closure version
    $oldRowDelete = "Tables\\Actions\\DeleteAction::make()\n                ->requiresConfirmation(false),";
    $newRowDelete  = "Tables\\Actions\\Action::make('delete')\n                ->label('Delete')\n                ->color('danger')\n                ->icon('heroicon-o-trash')\n                ->action(fn (\$record) => \$record->delete()),";

    if (str_contains($content, $oldRowDelete)) {
        $content = str_replace($oldRowDelete, $newRowDelete, $content);
        $changed = true;
    }

    // Replace bulk delete with a direct closure version
    $oldBulk = "Tables\\Actions\\DeleteBulkAction::make()\n                    ->requiresConfirmation(false),";
    $newBulk  = "Tables\\Actions\\BulkAction::make('delete')\n                    ->label('Delete Selected')\n                    ->color('danger')\n                    ->icon('heroicon-o-trash')\n                    ->action(fn (\$records) => \$records->each->delete()),";

    if (str_contains($content, $oldBulk)) {
        $content = str_replace($oldBulk, $newBulk, $content);
        $changed = true;
    }

    if ($changed) {
        file_put_contents($file, $content);
        echo "Patched: " . basename($file) . "\n";
    } else {
        echo "Skipped: " . basename($file) . "\n";
    }
}

echo "\nAll done!\n";
