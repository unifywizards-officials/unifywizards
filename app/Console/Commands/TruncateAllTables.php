<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class TruncateAllTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:truncate-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Truncating all tables...');

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Get all table names in the database
        $tables = DB::select('SHOW TABLES');
        $tableKey = 'Tables_in_' . env('DB_DATABASE'); // Adjust based on database name

        foreach ($tables as $table) {
            $tableName = $table->$tableKey;

            // Truncate each table
            DB::table($tableName)->truncate();
            $this->info("Truncated table: $tableName");
        }

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $this->info('All tables truncated successfully.');
        return 0;
    }
}
