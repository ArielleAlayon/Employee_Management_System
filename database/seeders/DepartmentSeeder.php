<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'dept_name' => 'Human Resources',
                'description' => 'Handles recruitment, employee relations, and benefits',
            ],
            [
                'dept_name' => 'Information Technology',
                'description' => 'Manages technology infrastructure and software development',
            ],
            [
                'dept_name' => 'Sales',
                'description' => 'Responsible for product sales and customer acquisition',
            ],
            [
                'dept_name' => 'Marketing',
                'description' => 'Handles brand promotion and marketing campaigns',
            ],
            [
                'dept_name' => 'Finance',
                'description' => 'Manages company finances and accounting',
            ],
            [
                'dept_name' => 'Operations',
                'description' => 'Oversees daily business operations',
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
