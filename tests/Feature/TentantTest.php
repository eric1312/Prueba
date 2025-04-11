<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use Tests\TestCase;

class TenantTest extends TestCase
{
    public function test_tenant_creation()
    {
        $user = $this->createUser();
        $system = System::factory()->create();

        $response = $this->actingAs($user)
            ->postJson("/api/v1/systems/{$system->id}/tenants", [
                'name' => 'Test Tenant',
                'subdomain' => 'testtenant',
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['id', 'name', 'subdomain']]);
    }

    public function test_tenant_database_created()
    {
        $tenant = Tenant::factory()->create(['database_name' => 'tenant_test']);
        
        $this->assertDatabaseHas('information_schema.schemata', [
            'schema_name' => $tenant->database_name,
        ]);
    }
}