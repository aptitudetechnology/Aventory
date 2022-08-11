<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DBBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup all tables with data';

    /**
     * @var Process
     */
    protected $process;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->file_path = sprintf('app/backups/backup_%s.sql', now()->format('Ymd'));
        $this->process = new Process(
            [
                'pg_dump',
                sprintf("--host=%s", config('database.connections.pgsql.host')),
                sprintf("--port=%s", config('database.connections.pgsql.port')),
                sprintf("--username=%s", config('database.connections.pgsql.username')),
                sprintf("--dbname=%s", config('database.connections.pgsql.database')),
                sprintf("--file=%s", storage_path($this->file_path)),
            ],
            null,
            [
                'PGPASSWORD' => config('database.connections.pgsql.password')
            ]
        );
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->info('The backup has been started');
            $this->process->mustRun();
            $this->info(sprintf('The backup has been proceed successfully. => %s', $this->file_path));
        } catch (ProcessFailedException $exception) {
            logger()->error('Backup exception', compact('exception'));
            $this->error('The backup process has been failed.');
        }
    }
}
