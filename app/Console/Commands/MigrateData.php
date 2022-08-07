<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from other database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $namespace = $this->getMigrateNamespace();
        $customers = $this->getCustomers();
        $name = $this->choice('Which customer data do you want to migrate?', array_keys($customers), 0);

        $this->call('db:seed', [
            '--class' => $namespace . $customers[$name]
        ]);
    }

    public function getCustomers()
    {
        return [
            'GardenGateNursery' => 'GardenGateNurseryDataSeeder'
        ];
    }

    public function getMigrateNamespace() {
        return 'Database\\Seeders\\Customers\\';
    }
}
