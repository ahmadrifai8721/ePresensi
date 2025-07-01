<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Console\Command;

class AddAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addAdmin {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Buat pengguna admin baru dengan email dan password yang diberikan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');


        $getAdminID = User::create([
            "name" => $this->argument('name'),
            "email" => $this->argument('email'),
            "password" => bcrypt($this->argument('password')),
        ]);
        $getAdminRole = Role::where("role", "Administrator")->first();

        UserRole::create([
            "role_id" => $getAdminRole->id,
            "user_id" => $getAdminID->id,
        ]);


        $this->info('Admin user created successfully.');
    }
}
