<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckUserRolesSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:check-roles-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica el estado de sincronización entre el campo rol y la tabla de relaciones';

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
        $this->info('Verificando sincronización de roles...');
        
        $users = User::with('roles')->get();
        $synced = 0;
        $desynced = 0;
        
        $this->table(
            ['ID', 'Usuario', 'Rol en Campo', 'Roles en Tabla', 'Estado'],
            $users->map(function ($user) use (&$synced, &$desynced) {
                $roles = $user->roles->pluck('name')->toArray();
                $isSynced = in_array($user->rol, $roles) && count($roles) === 1;
                
                if ($isSynced) {
                    $synced++;
                    $status = '✅ Sincronizado';
                } else {
                    $desynced++;
                    $status = '❌ Desincronizado';
                }
                
                return [
                    $user->id,
                    $user->name,
                    $user->rol ?? 'Sin rol',
                    implode(', ', $roles) ?: 'Sin roles',
                    $status
                ];
            })
        );
        
        $this->info("\nResumen:");
        $this->line("✅ Usuarios sincronizados: {$synced}");
        $this->line("❌ Usuarios desincronizados: {$desynced}");
        
        if ($desynced > 0) {
            $this->warn("\nPara corregir usuarios desincronizados, ejecuta:");
            $this->line("php artisan users:sync-roles");
        }
        
        return 0;
    }
}
