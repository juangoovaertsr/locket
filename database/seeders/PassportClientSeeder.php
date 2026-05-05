<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class PassportClientSeeder extends Seeder
{
    public function run(ClientRepository $clients): void
    {
        try {
            $clients->personalAccessClient('users');
            $this->command->info('Personal access client already exists for users provider.');

            return;
        } catch (\RuntimeException) {
            // Falls through to create one.
        }

        $client = $clients->createPersonalAccessGrantClient(
            config('app.name').' Personal Access Client',
            'users',
        );

        $this->command->info("Created personal access client (id={$client->getKey()}).");
    }
}
