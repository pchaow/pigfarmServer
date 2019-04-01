<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\QuaterReportService;
class QuaterBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:quater';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate quater report to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(QuaterReportService $service)
    {
        parent::__construct();
        $this->service = $service;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->service->generateQuaterReport();
    }
}
