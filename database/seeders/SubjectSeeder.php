<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'English Language',
                'description' => 'Core language subject focusing on comprehension, grammar, essay writing, and oral English.',
                'banner' => 'subjects/english.png',
                'courses' => [1, 2, 3, 4],
                'departments' => ['general'],
            ],
            [
                'name' => 'Mathematics',
                'description' => 'Covers arithmetic, algebra, geometry, statistics, and problem-solving skills.',
                'banner' => 'subjects/mathematics.png',
                'courses' => [1, 2, 3, 4],
                'departments' => ['general'],
            ],
            [
                'name' => 'Biology',
                'description' => 'Study of living organisms including plants, animals, and human biology.',
                'banner' => 'subjects/biology.png',
                'courses' => [1, 2, 3, 4],
                'departments' => ['science'],
            ],
            [
                'name' => 'Chemistry',
                'description' => 'Focuses on chemical reactions, equations, organic and inorganic chemistry.',
                'banner' => 'subjects/chemistry.png',
                'courses' => [1, 2, 3, 4],
                'departments' => ['science'],
            ],
            [
                'name' => 'Physics',
                'description' => 'Covers mechanics, electricity, waves, and modern physics concepts.',
                'banner' => 'subjects/physics.png',
                'courses' => [1, 2, 3, 4],
                'departments' => ['science'],
            ],
            [
                'name' => 'Economics',
                'description' => 'Introduces economic principles, demand and supply, and national income.',
                'banner' => 'subjects/economics.png',
                'courses' => [1, 2, 3, 4],
                'departments' => ['commercial'],
            ],
            [
                'name' => 'Government',
                'description' => 'Study of political systems, governance, constitutions, and civic responsibilities.',
                'banner' => 'subjects/government.png',
                'courses' => [1, 2, 3, 4],
                'departments' => ['art'],
            ],
            [
                'name' => 'Literature in English',
                'description' => 'Analysis of prose, drama, and poetry with literary appreciation.',
                'banner' => 'subjects/literature.png',
                'courses' => [1, 2, 3, 4],
                'departments' => ['art'],
            ],
            [
                'name' => 'Accounting',
                'description' => 'Principles of bookkeeping, financial accounts, and business records.',
                'banner' => 'subjects/accounting.png',
                'courses' => [1, 2, 3, 4],
                'departments' => ['commercial'],
            ],
            [
                'name' => 'Commerce',
                'description' => 'Covers trade, business organizations, and commercial activities.',
                'banner' => 'subjects/commerce.png',
                'courses' => [1, 2, 3, 4],
                'departments' => ['commercial'],
            ],
            [
                'name' => 'Agricultural Science',
                'description' => 'Study of farming practices, crops, livestock, and soil science.',
                'banner' => 'subjects/agriculture.png',
                'courses' => [1, 2, 3, 4],
                'departments' => ['science'],
            ],
            [
                'name' => 'Civic Education',
                'description' => 'Teaches civic responsibilities, citizenship, and moral values.',
                'banner' => 'subjects/civic.png',
                'courses' => [2, 3, 4],
                'departments' => ['general'],
            ],
            [
                'name' => 'Geography',
                'description' => 'Study of physical and human geography including maps and environment.',
                'banner' => 'subjects/geography.png',
                'courses' => [2, 3, 4],
                'departments' => ['science', 'art'],
            ],
            [
                'name' => 'CRS / IRS',
                'description' => 'Religious studies covering Christian and Islamic teachings.',
                'banner' => 'subjects/religion.png',
                'courses' => [2, 3, 4],
                'departments' => ['art'],
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate(
                ['name' => $subject['name']], 
                [
                'name' => $subject['name'],
                'description' => $subject['description'],
                'banner' => $subject['banner'],
                'courses' => $subject['courses'],
                'departments' => $subject['departments'],
                'assignees' => [], // assign tutors later
                'status' => 'active',
            ]);
        }
    }
}
