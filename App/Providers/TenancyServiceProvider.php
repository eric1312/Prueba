<?php

namespace App\Providers;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class TenancyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('currentTenant', function () {
            return null;
        });
    }

    public function boot()
    {
        $this->configureRequests();
        $this->configureQueue();
    }

    protected function configureRequests()
    {
        if (! $this->app->runningInConsole()) {
            $host = request()->getHost();
            
            if ($tenant = Tenant::where('subdomain', explode('.', $host)[0])->first()) {
                $this->setTenant($tenant);
            }
        }
    }

    protected function configureQueue()
    {
        $this->app['queue']->createPayloadUsing(function () {
            return $this->app['currentTenant'] ? ['tenant_id' => $this->app['currentTenant']->id] : [];
        });

        DB::beforeExecuting(function ($connection, $query, $bindings, $database) {
            if ($connection === 'tenant' && $this->app['currentTenant']) {
                $database = $this->app['currentTenant']->database_name;
                config(['database.connections.tenant.database' => $database]);
                DB::purge('tenant');
            }
        });
    }

    protected function setTenant(Tenant $tenant)
    {
        $this->app['currentTenant'] = $tenant;
        
        // Configurar la base de datos del tenant
        config(['database.connections.tenant.database' => $tenant->database_name]);
        DB::purge('tenant');
        
        // Configurar el sistema de archivos
        config(['filesystems.disks.tenant' => [
            'driver' => 'local',
            'root' => storage_path("app/tenants/{$tenant->id}"),
        ]]);
    }
}