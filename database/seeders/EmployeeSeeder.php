<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            // HR Department (ID: 1)
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@company.com',
                'phone' => '555-0101',
                'position' => 'HR Manager',
                'salary' => 65000.00,
                'department_id' => 1,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Chen',
                'email' => 'michael.chen@company.com',
                'phone' => '555-0102',
                'position' => 'Recruitment Specialist',
                'salary' => 52000.00,
                'department_id' => 1,
            ],

            // IT Department (ID: 2)
            [
                'first_name' => 'David',
                'last_name' => 'Rodriguez',
                'email' => 'david.rodriguez@company.com',
                'phone' => '555-0201',
                'position' => 'Senior Developer',
                'salary' => 85000.00,
                'department_id' => 2,
            ],
            [
                'first_name' => 'Lisa',
                'last_name' => 'Wang',
                'email' => 'lisa.wang@company.com',
                'phone' => '555-0202',
                'position' => 'Frontend Developer',
                'salary' => 72000.00,
                'department_id' => 2,
            ],
            [
                'first_name' => 'James',
                'last_name' => 'Wilson',
                'email' => 'james.wilson@company.com',
                'phone' => '555-0203',
                'position' => 'System Administrator',
                'salary' => 68000.00,
                'department_id' => 2,
            ],

            // Sales Department (ID: 3)
            [
                'first_name' => 'Jennifer',
                'last_name' => 'Martinez',
                'email' => 'jennifer.martinez@company.com',
                'phone' => '555-0301',
                'position' => 'Sales Manager',
                'salary' => 75000.00,
                'department_id' => 3,
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Taylor',
                'email' => 'robert.taylor@company.com',
                'phone' => '555-0302',
                'position' => 'Sales Representative',
                'salary' => 55000.00,
                'department_id' => 3,
            ],

            // Marketing Department (ID: 4)
            [
                'first_name' => 'Amanda',
                'last_name' => 'Brown',
                'email' => 'amanda.brown@company.com',
                'phone' => '555-0401',
                'position' => 'Marketing Director',
                'salary' => 78000.00,
                'department_id' => 4,
            ],
            [
                'first_name' => 'Kevin',
                'last_name' => 'Davis',
                'email' => 'kevin.davis@company.com',
                'phone' => '555-0402',
                'position' => 'Content Specialist',
                'salary' => 58000.00,
                'department_id' => 4,
            ],

            // Finance Department (ID: 5)
            [
                'first_name' => 'Patricia',
                'last_name' => 'Miller',
                'email' => 'patricia.miller@company.com',
                'phone' => '555-0501',
                'position' => 'Finance Manager',
                'salary' => 82000.00,
                'department_id' => 5,
            ],
            [
                'first_name' => 'Thomas',
                'last_name' => 'Anderson',
                'email' => 'thomas.anderson@company.com',
                'phone' => '555-0502',
                'position' => 'Accountant',
                'salary' => 60000.00,
                'department_id' => 5,
            ],

            // Operations Department (ID: 6)
            [
                'first_name' => 'Maria',
                'last_name' => 'Garcia',
                'email' => 'maria.garcia@company.com',
                'phone' => '555-0601',
                'position' => 'Operations Manager',
                'salary' => 70000.00,
                'department_id' => 6,
            ],
            [
                'first_name' => 'Christopher',
                'last_name' => 'Lee',
                'email' => 'christopher.lee@company.com',
                'phone' => '555-0602',
                'position' => 'Operations Coordinator',
                'salary' => 53000.00,
                'department_id' => 6,
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}