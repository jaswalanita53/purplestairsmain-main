<?php
namespace App\Imports;
use App\Models\User;
use App\Models\Personal;
use App\Models\Education;
use App\Models\Employment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)

    {

        if(empty($row['email'])){
            return null;
        }
        $row['email'] = str_replace('+AEA-', '@', $row['email']);

        $existingUser = User::where('email', $row['email'])->first();

        if ($existingUser) {
            // User with email already exists, do nothing or handle as needed
            return null;
        }

        $password = Hash::make($row['password']);

        $user = User::create([
            'name' => $row['name'] ?? $row['email'],
            'email' => $row['email'],
            'password' => $password,
            'reminder_status' => 1,
            'days3_reminder_status' => 1,
            'days6_reminder_status' => 1,
            'email_verified_at' => Carbon::now(),

            // Add other user fields as needed
        ]);


        // Create personal information
        Personal::create([
            'user_id' => $user->id,
            'phone' => $row['phone'] ?? null,
            'name' => $row['name'] ?? $row['email'],
            'email' => $row['email'],
            'current_title' => $row['current_title'] ?? null,
            // Add other personal information fields as needed
        ]);

        // Create education records
        // Education::create([
        //     'user_id' => $user->id,
        //     'program_name' => $row['program_name'] ?? null,
        //     // Add other education fields as needed
        // ]);


        return $user;
    }
}
