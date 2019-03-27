<?php

namespace App\Console\Commands;

use App\Http\Services\DailyReportService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DailyBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:daily {{--date=}}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate daily report to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DailyReportService $service)
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
        if($this->option('date')){
            $date = Carbon::createFromFormat("Y-m-d",$this->option('date'))->toDateString();
        }else {
            $date = Carbon::now();
        }
        $this->service->generateDailyReport($date);
    }
}
