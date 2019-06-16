<?php

namespace App\Console\Commands;

use App\Http\Services\QuaterReportService;
use Illuminate\Console\Command;

class QuaterBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:quater {{--year=}} {{--quater=}}';

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
        if ($this->option('year')) {
            $year = $this->option('year');
        } else {
            $year = date('Y');
        }

        if ($this->option('year')) {
            $quater = $this->option('quater');
        } else {
            $quater = $this->getQuater();
        }

    
        
        $this->service->generateQuaterReport($year, $quater);
    }

    private function getQuater()
    {
        $calendar = \Carbon\Carbon::now();
        $month = $calendar->month;
       
            if ($month <= 3) {
                $quaterNumber = 1;
            } else if ($month <= 6) {
                $quaterNumber = 2;
            } else if ($month <= 9) {
                $quaterNumber = 3;
            } else {
                $quaterNumber = 4;
            }

            return $quaterNumber;
      
    }

}
