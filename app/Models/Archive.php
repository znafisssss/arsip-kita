<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'is_private',
    ];

    protected $casts = [
        'is_private' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getFileSizeFormattedAttribute(): string
    {
        return self::formatBytes($this->file_size);
    }

    public static function formatBytes($bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' B';
        }
    }

    public function getFileUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    public function isImage(): bool
    {
        return in_array(strtolower($this->file_type), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
    }

    public function isPdf(): bool
    {
        return strtolower($this->file_type) === 'pdf';
    }

    public function isVideo(): bool
    {
        return in_array(strtolower($this->file_type), ['mp4', 'avi', 'mov', 'wmv', 'webm']);
    }
}
