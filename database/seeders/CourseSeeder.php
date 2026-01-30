<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title' => 'JAMB',
                'description' => 'The Joint Admissions and Matriculation Board (JAMB) preparation course is designed to help students gain admission into Nigerian universities, polytechnics, and colleges of education. This course covers all required subjects, CBT practice tests, exam strategies, and past questions to ensure maximum success.',
                'price' => 8000,
                'banner' => 'courses/jamb.png',
            ],
            [
                'title' => 'WAEC',
                'description' => 'The West African Examinations Council (WAEC) course prepares secondary school students for their final external examinations. It includes comprehensive subject coverage, revision classes, mock exams, and examiner-guided explanations to help students achieve excellent results.',
                'price' => 12000,
                'banner' => 'courses/waec.png',
            ],
            [
                'title' => 'NECO',
                'description' => 'The National Examinations Council (NECO) preparation course focuses on in-depth understanding of key subjects, frequent assessments, and past question reviews to help students pass their SSCE with confidence.',
                'price' => 12000,
                'banner' => 'courses/neco.png',
            ],
            [
                'title' => 'GCE',
                'description' => 'The General Certificate Examination (GCE) course is designed for private candidates and re-sit students. It provides flexible learning schedules, expert-led tutorials, and targeted exam preparation for quick academic recovery.',
                'price' => 12000,
                'banner' => 'courses/gce.png',
            ],
        ];

        foreach ($courses as $course) {
            Course::create([
                'title'       => $course['title'],
                'slug'        => Str::slug($course['title']),
                'description' => $course['description'],
                'banner'      => $course['banner'],
                'status'      => 'active',
                'price'       => $course['price'],
            ]);
        }
    }
}
