<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class dellAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dellAdmin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus User Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $this->info("Menghapus User Admin...");
        $user = \App\Models\User::where("email", $this->argument('email'))->first();
        if ($user) {
            $user->delete();
            $this->info("User Admin Berhasil Dihapus");
        } else {
            $this->info("User Admin Tidak Ditemukan");
        }
    }
}
