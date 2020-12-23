<?php

namespace App\Console\Commands;

use App\Services\UrlService;
use Illuminate\Console\Command;

class GenerateUrlKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url-key:generate {--n= : Number of generated records}
                                             {--key-length= : Length of key, default is 6}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate url key for url shortener';

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
     * @param UrlService $urlService
     * @return void
     */
    public function handle(UrlService $urlService)
    {
        $count = 0;
        $goalNumber = $this->option('n') ?? 50000;
        $keyLength = $this->option('key-length') ?? 6;
        $progressBar = $this->output->createProgressBar($goalNumber);
        $progressBar->start();
        while ($count < $goalNumber) {
            $key = $urlService->generateKey($keyLength);
            try {
                $urlService->createUrlMapping($key);
                $count++;
                $progressBar->advance();
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}
