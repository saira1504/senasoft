<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SyncUserRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:sync-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza el campo rol de los usuarios con sus roles en la tabla de relaciones';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Sincronizando roles de usuarios...');
        
        $users = User::with('roles')->get();
        $updated = 0;
        
        foreach ($users as $user) {
            $user->syncRolField();
            $updated++;
            $this->line("Usuario {$user->name} sincronizado con rol: {$user->rol}");
        }
        
        $this->info("Se sincronizaron {$updated} usuarios exitosamente.");
        
        return 0;
    }
}
