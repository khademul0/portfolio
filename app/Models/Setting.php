<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    protected static $settings = null;

    public static function get(string $key, $default = null)
    {
        if (self::$settings === null) {
            self::$settings = static::pluck('value', 'key')->toArray();
        }
        
        return self::$settings[$key] ?? $default;
    }

    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        self::$settings = null; // Clear cache on update
    }
}
