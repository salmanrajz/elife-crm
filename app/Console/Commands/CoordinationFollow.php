<?php

namespace App\Console\Commands;

use App\lead_sale;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CoordinationFollow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CoordinationFollow:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert Daily Pending Coordination to Follow Up Coordination';

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
     * @return int
     */
    public function handle()
    {
        // return 0;
        // $s = lead_sale::where(['date_time', ]);
        // $posts = lead_sale::whereDate('created_at', Carbon::today())->get();
        $posts = lead_sale::select('lead_sales.*')
        ->whereDate('updated_at', Carbon::today())
        ->where('status', '1.07')->get();
        if($posts){
            foreach ($posts as $k => $value) {
                // echo $k . '<br>';
                // echo $value->id . '<br>';
                $p = lead_sale::findorfail($value->id);
                $p->status = '1.16';
                $p->remarks = 'Time Out, Please Proceed Next Day Immediately';
                $p->save();
            }
        }
        //
        $posts = lead_sale::select('lead_sales.*')
        ->whereDate('updated_at', Carbon::today())
        ->where('status', '1.10')->get();
        if($posts){
            foreach ($posts as $k => $value) {
                // echo $k . '<br>';
                // echo $value->id . '<br>';
                $p = lead_sale::findorfail($value->id);
                $p->status = '1.17';
                $p->remarks = 'Time Out, Please Proceed Next Day Immediately';
                $p->save();
            }
        }


    }
}
