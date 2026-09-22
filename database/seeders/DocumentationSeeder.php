<?php

namespace Database\Seeders;

use App\Models\DocumentationCategory;
use App\Models\DocumentationPhoto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DocumentationSeeder extends Seeder
{
    public function run(): void
    {
        if (DocumentationCategory::count() > 0) {
            return;
        }

        $categoriesData = [
            [
                'title_id' => 'Dokumentasi Bimbingan & Pelatihan Sains',
                'title_en' => 'Science Mentoring & Training Documentation',
                'slug' => 'dokumentasi-bimbingan-pelatihan-sains',
                'description_id' => 'Dokumentasi kegiatan pelatihan, workshop, dan bimbingan sains bagi para peserta didik.',
                'description_en' => 'Documentation of training workshops and science mentoring activities for students.',
                'cover_image' => 'images/slide1.jpg',
                'sort_order' => 1,
                'photos' => [
                    [
                        'title_id' => 'Sesi Bimbingan Tatap Muka',
                        'title_en' => 'Face-to-Face Mentoring Session',
                        'image' => 'images/slide1.jpg',
                    ],
                    [
                        'title_id' => 'Diskusi Materi Pembelajaran',
                        'title_en' => 'Learning Material Discussion',
                        'image' => 'images/slide2.jpg',
                    ],
                    [
                        'title_id' => 'Praktikum dan Bimbingan Intensif',
                        'title_en' => 'Practical & Intensive Mentoring',
                        'image' => 'images/slide3.jpg',
                    ]
                ]
            ],
            [
                'title_id' => 'Dokumentasi Penyerahan Penghargaan & Medali',
                'title_en' => 'Awarding Ceremony & Medal Presentation Documentation',
                'slug' => 'dokumentasi-penyerahan-penghargaan-medali',
                'description_id' => 'Dokumentasi momen penganugerahan medali, piagam penghargaan, dan piala kepada para juara.',
                'description_en' => 'Documentation of medal presentations, certificates, and trophies to champions.',
                'cover_image' => 'images/slide2.jpg',
                'sort_order' => 2,
                'photos' => [
                    [
                        'title_id' => 'Penyerahan Medali Kejuaraan',
                        'title_en' => 'Championship Medal Presentation',
                        'image' => 'images/slide2.jpg',
                    ],
                    [
                        'title_id' => 'Foto Bersama Para Juara',
                        'title_en' => 'Group Photo with Champions',
                        'image' => 'images/slide3.jpg',
                    ],
                    [
                        'title_id' => 'Pemberian Sertifikat Penghargaan',
                        'title_en' => 'Award Certificate Presentation',
                        'image' => 'images/slide1.jpg',
                    ]
                ]
            ],
            [
                'title_id' => 'Dokumentasi Pelaksanaan Pelatihan & Ujian',
                'title_en' => 'Exam & Training Execution Documentation',
                'slug' => 'dokumentasi-pelaksanaan-pelatihan-ujian',
                'description_id' => 'Suasana pelaksanaan ujian dan pelatihan nasional yang diselenggarakan secara tertib dan transparan.',
                'description_en' => 'Atmosphere of national exams and training conducted orderly and transparently.',
                'cover_image' => 'images/slide3.jpg',
                'sort_order' => 3,
                'photos' => [
                    [
                        'title_id' => 'Suasana Pelaksanaan Ujian',
                        'title_en' => 'Exam Atmosphere',
                        'image' => 'images/slide3.jpg',
                    ],
                    [
                        'title_id' => 'Pengawasan Pelaksanaan Ujian',
                        'title_en' => 'Exam Supervision',
                        'image' => 'images/slide1.jpg',
                    ]
                ]
            ]
        ];

        foreach ($categoriesData as $catData) {
            $photos = $catData['photos'];
            unset($catData['photos']);

            $category = DocumentationCategory::create($catData);

            foreach ($photos as $index => $photoData) {
                $photoData['documentation_category_id'] = $category->id;
                $photoData['sort_order'] = $index + 1;
                DocumentationPhoto::create($photoData);
            }
        }
    }
}
