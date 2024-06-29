<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateAPIKEY extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate_api_key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generare una chiave per l\'API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = bin2hex(random_bytes(32));

        file_put_contents(base_path('.env'), PHP_EOL . "API_KEY=$key" . PHP_EOL, FILE_APPEND);

        $this->info("API Key: $key");
    }
}
