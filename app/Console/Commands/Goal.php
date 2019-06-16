<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\ReportGoalGenerater;

class Goal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:goal {{--type=}} {{--year=}} {{--date=}}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ReportGoalGenerater $service)
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
        
        if($this->option('type')){
            $year = $this->option('type');
        }else {
            $year =  'year';
        }
        if($this->option('year')){
            $type = $this->option('year');
        }else {
            $type = date('Y');
        }
        if($this->option('date')){
            $date = $this->option('date');
        }else {
            $date = date('Y-MM-DD');
        }
        $this->service->generateGoalReport($type,$year,$date);
    }
}
