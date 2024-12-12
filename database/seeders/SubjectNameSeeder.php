<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subject_names')->insert([
            [
                'subject_name_id' => '62',
                'subject_name' => 'Bahasa Jawa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '97',
                'subject_name' => 'Ilmu Pengetahuan Alam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '100',
                'subject_name' => 'Ilmu Pengetahuan Sosial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '154',
                'subject_name' => 'Pendidikan Kewarganegaraan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '156',
                'subject_name' => 'Bahasa Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '157',
                'subject_name' => 'Bahasa Inggris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            [
                'subject_name_id' => '180',
                'subject_name' => 'Matematika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '217',
                'subject_name' => 'Seni Budaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '220',
                'subject_name' => 'Pendidikan Jasmani, Olahraga dan Kesehatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '224',
                'subject_name' => 'Teknologi Informasi dan Komunikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '227',
                'subject_name' => 'Prakarya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '235',
                'subject_name' => 'Akidah Akhlak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '236',
                'subject_name' => 'Al Quran Hadits',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '237',
                'subject_name' => 'Fiqih',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '238',
                'subject_name' => 'Sejarah Kebudayaan Islam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name_id' => '239',
                'subject_name' => 'Bahasa Arab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
