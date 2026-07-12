<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id_user' => '1',
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'id_user' => '2',
            'name' => 'Operator Inventaris',
            'username' => 'operator',
            'email' => 'operator@gmail.com',
            'password' => Hash::make('operator'),
            'role' => 'operator',
        ]);

        User::create([
            'id_user' => '3',
            'name' => 'Sarana Prasarana',
            'username' => 'sarpras',
            'email' => 'sarpras@gmail.com',
            'password' => Hash::make('sarpras'),
            'role' => 'sarpras',
        ]);

        User::create([
            'id_user' => '4',
            'name' => 'Kepala Sarpras',
            'username' => 'kepala',
            'email' => 'kepala@gmail.com',
            'password' => Hash::make('kepala'),
            'role' => 'kepala_sarpras',
        ]);

        User::create([
            'id_user' => '5',
            'name' => 'Budi Hermawan',
            'username' => 'guru',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('guru'),
            'role' => 'guru',
            'nik' => '198001012005011002',
        ]);
    }
}
