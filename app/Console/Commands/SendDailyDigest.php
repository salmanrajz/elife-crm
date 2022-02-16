<?php

namespace App\Console\Commands;

use App\customer_notification;
use App\lead_sale;
use App\numberdetail;
use Carbon\Carbon;
use Illuminate\Console\Command;
// use str
class SendDailyDigest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily_digest:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Daily notifications';

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
        // $id = Str::random(10);
        // $id = 'sam';
        $p = customer_notification::create([
            'lead_id' => '0',
            'type' => 'pending',
            'userid' => '0',
            'status' => '0',
        ]);
        // $value = lead_sale::select("lead_sales.*")
        // ->where('later_date', '!=', '')
        // ->where('lead_type',  'postpaid')
        // ->where('status','1.06')
        // // ->where('pre_check_agent', auth()->user()->id)
        //     // ->where('id','17')
        // ->get();
        // foreach ($value as $key => $l) {
        //     # code...

        //     // return $l->later_date;
        //     $startTime = Carbon::parse($l->later_date);
        //     $now = Carbon::now()->toDateTimeString();
        //     $endTime = Carbon::parse($now);
        //     $totalDuration = $endTime->diffForHumans($startTime);
        //     // dd($totalDuration);
        //     // // return $totalDuration;
        //     if ($totalDuration < '15 minutes before' || $totalDuration > '15 Minutes after') {
        //         // return "oh yes";
        //         //     $dd = customer_notification::create([
        //         //     'lead_id' => $l->id,
        //         //     'userid' => $l->pre_check_agent,
        //         //     'type' => 'pending',
        //         //     'status' => '1',
        //         // ]);
        //         $count = customer_notification::whereLead_id($l->id)->count();
        //         if ($count > 0) {
        //         } else {
        //             $dd = customer_notification::create([
        //                 'lead_id' => $l->id,
        //                 'userid' => $l->pre_check_agent,
        //                 'type' => 'pending',
        //                 'status' => '1',
        //             ]);
        //         }
        //     // $k = lead_sale::findorfail($l->id);
        //     // $k->pre_check_remarks = 'Remarks for later launch the later popup immediately';
        //     // $k->save();
        //     // return "done";
        //     // $s = customer_notification::select('custom_notification.*')
        //     } else {
        //         // return "s";
        //     }
        // }
        // $d = numberdetail::where("id",1)->delete();
        // info("Delete happend");
        // notify()->info('User has been succesfully deleted');
        // sleep(4);
        // info("finished it");


    }
}
