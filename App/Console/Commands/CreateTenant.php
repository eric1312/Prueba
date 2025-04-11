<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateTenant extends Command
{
    protected $signature = 'tenant:create {subdomain} {--name=} {--system=}';
    protected $description = 'Create a new tenant';

    public function handle()
    {
        $subdomain = $this->argument('subdomain');
        $name = $this->option('name') ?? $subdomain;
        $systemId = $this->option('system');

        $tenant = Tenant::create([
            'name' => $name,
            'subdomain' => $subdomain,
            'database_name' => 'tenant_' . $subdomain,
            'system_id' => $systemId,
            'status' => 'active',
        ]);

        $this->createDatabase($tenant);
        $this->runMigrations($tenant);

        $this->info("Tenant {$tenant->name} created successfully!");
    }

    protected function createDatabase(Tenant $tenant)
    {
        DB::statement("CREATE DATABASE IF NOT EXISTS {$tenant->database_name}");
    }

    protected function runMigrations(Tenant $tenant)
    {
        config(['database.connections.tenant.database' => $tenant->database_name]);
        DB::purge('tenant');

        $this->call('migrate', [
            '--database' => 'tenant',
            '--path' => 'database/migrations/tenant',
            '--force' => true,
        ]);
    }
}