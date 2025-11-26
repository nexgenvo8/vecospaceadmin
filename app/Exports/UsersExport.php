<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromArray, WithHeadings
{
    protected $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function array(): array
    {
        $userTypes = [
            1 => 'Student',
            2 => 'Faculty',
            3 => 'Alumni',
            4 => 'Industry Professional',
            5 => 'Career Enhancer / Service Provider',
        ];

        $data = [];

        foreach ($this->users as $index => $user) {
            $data[] = [
                $index + 1,
                ($user['firstName'] ?? '') . ' ' . ($user['lastName'] ?? ''),
                $userTypes[$user['userstype'] ?? ''] ?? 'Not Yet Selected',
                $user['coursename'] ?? '-',
                $user['departmentname'] ?? '-',
                $user['passingyear'] ?? '-',
                $user['industryName'] ?? '-',
                $user['email'] ?? '-',
                $user['mobile'] ?? '-',
                $user['dob'] ?? '-',
                ($user['activeYN'] ?? '') == 'Y' ? 'Active' : 'Inactive',
                isset($user['created_at']) ? \Carbon\Carbon::parse($user['created_at'])->setTimezone('Asia/Kolkata')->format('d-m-Y H:i:s') : '-'
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Sr No',
            'Full Name',
            'User Type',
            'Course',
            'Department',
            'Passing Year',
            'Industry',
            'Email',
            'Mobile',
            'Date of Birth',
            'Status',
            'Created Date'
        ];
    }
}