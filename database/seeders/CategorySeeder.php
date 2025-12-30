<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Dokumen',
                'icon' => '📄',
                'color' => '#3B82F6', // Blue
            ],
            [
                'name' => 'Foto',
                'icon' => '📸',
                'color' => '#10B981', // Green
            ],
            [
                'name' => 'Sertifikat',
                'icon' => '🎓',
                'color' => '#F59E0B', // Amber
            ],
            [
                'name' => 'Video',
                'icon' => '🎥',
                'color' => '#EF4444', // Red
            ],
            [
                'name' => 'KTP & Identitas',
                'icon' => '🪪',
                'color' => '#8B5CF6', // Purple
            ],
            [
                'name' => 'Ijazah',
                'icon' => '📜',
                'color' => '#EC4899', // Pink
            ],
            [
                'name' => 'Kontrak',
                'icon' => '📝',
                'color' => '#6366F1', // Indigo
            ],
            [
                'name' => 'Faktur & Invoice',
                'icon' => '🧾',
                'color' => '#14B8A6', // Teal
            ],
            [
                'name' => 'Lainnya',
                'icon' => '📦',
                'color' => '#6B7280', // Gray
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
