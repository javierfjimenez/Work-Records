<?php
use App\Models\User;
use App\Models\WorkRecord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;


uses(RefreshDatabase::class);

it('allows a user to create a work record', function () {
    $user = User::factory()->create();
    actingAs($user, 'sanctum');

    $response = $this->postJson('/api/work_records', [
        'title' => 'Test Work',
        'start_time' => now(),
        'end_time' => now()->addHour(),
        'priority' => 'alta',
        'description' => 'Testing work record creation'
    ]);

    $response->assertStatus(201);
    expect(WorkRecord::count())->toBe(1);
});

it('allows a user to update a work record', function () {
    $user = User::factory()->create();
    $workRecord = WorkRecord::factory()->create(['user_id' => $user->id]);

    actingAs($user, 'sanctum');

    $response = $this->putJson("/api/work_records/{$workRecord->id}", [
        'title' => 'Updated Work',
        'priority' => 'alta',
        'start_time' => now(),
    ]);

    $response->assertStatus(200);
    expect(WorkRecord::first()->title)->toBe('Updated Work');
});

it('allows a user to delete a work record', function () {
    $user = User::factory()->create();
    $workRecord = WorkRecord::factory()->create(['user_id' => $user->id]);

    actingAs($user, 'sanctum');

    $response = $this->deleteJson("/api/work_records/{$workRecord->id}");

    $response->assertStatus(200);
    expect(WorkRecord::count())->toBe(0);
});

