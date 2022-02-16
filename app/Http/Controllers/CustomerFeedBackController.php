<?php

namespace App\Http\Controllers;

use App\CustomerFeedBack;
use Illuminate\Http\Request;
use Carbon\Carbon;


class CustomerFeedBackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('auth.feedback');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $request;
        $sam = rand(0323,31231);
        $arr_sendRequest['user'] = '20091153';
        $arr_sendRequest['pwd'] = "Core!5Core";
        $arr_sendRequest['number'] = '971'.$request->number;
        $arr_sendRequest['msg'] = "Your One Time OTP IS =>" . $sam;
        $arr_sendRequest['sender'] = "SMS Alert";
        $arr_sendRequest['language'] = "Unicode";
        $k = array($arr_sendRequest);
        $jon = json_encode($k);
        $url = 'https://mshastra.com/sendsms_api_json.aspx';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1); 

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jon);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        $result = curl_exec($ch);

        // $d = customerFeedBack::create[()]
        $data = customerFeedBack::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->number,
            'alternative_number' => $request->alternative_number,
            'validation_code' => $sam,
            'plan_desc' => $request->plan_desc,
            'lead_date' => Carbon::now()->toDateTimeString(),
        ]);
        return redirect(route('feedback.edit',$data->id));
        // return "Hello Whats OTP CODE";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerFeedBack  $customerFeedBack
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerFeedBack $customerFeedBack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerFeedBack  $customerFeedBack
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerFeedBack $customerFeedBack,$id)
    {
        //
        $data = customerFeedBack::findorfail($id);
        return view('auth.otp',compact('data'));
        // return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerFeedBack  $customerFeedBack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerFeedBack $customerFeedBack,$id)
    {
        //
        // return $id;
        $data = customerFeedBack::findorfail($id);
        // $data->v
        if($data->validation_code != $request->otp){
            notify()->error('OTP Is Wrong, Please Try Again');

            return redirect()->back()->with('error','OTP IS WRONG');
        }
        else{
            $data->update([
                'status' => 1,
                'validation_code' => 0
            ]);
            // return
            notify()->info('User Succesfully Verified');
            $arr_sendRequest['user'] = '20091153';
            $arr_sendRequest['pwd'] = "Core!5Core";
            $arr_sendRequest['number'] = '971'.$data->phone_number;
            $arr_sendRequest['msg'] = "Thank you for Choosing New Home Internet Service";
            $arr_sendRequest['sender'] = "SMS Alert";
            $arr_sendRequest['language'] = "Unicode";
            $k = array($arr_sendRequest);
            $jon = json_encode($k);
            $url = 'https://mshastra.com/sendsms_api_json.aspx';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
            curl_setopt($ch, CURLOPT_POST, 1); 

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jon);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            $result = curl_exec($ch);
            // $name = 'Salman';
            // $number = 'Salman';
            // $alternativeNumber = 'Salman';
            // $Email = 'Salman';
            $details = [
                'title' => 'Mail from Home Internet Service',
                'body' => 'Customer Details',
                'CustomerName' => $data->name,
                'CustomerNumber' => $data->phone_number,
                'AlternativeNumber' => $data->alternative_number,
                'CustomerEmail' => $data->email,
                'PlanDescription' => $data->plan_desc,
            ];
        
            \Mail::to('leadselife@gmail.com')->send(new \App\Mail\HomeServiceMail($details));

        // return redirect()->back()->withInput();
            return redirect(route('feedback.index'));
            // return "yes you passed";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerFeedBack  $customerFeedBack
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerFeedBack $customerFeedBack)
    {
        //
    }
}
