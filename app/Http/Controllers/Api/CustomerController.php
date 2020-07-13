<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Nexmo\Laravel\Facade\Nexmo;
use Twilio\Rest\Client;
use App\Http\Controllers\SmsController;
use App\Jobs\JobEmail;
use App\Jobs\JobSms;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::orderByDesc('id')->get();
        $result = ["status" => 200];

        try{
            $result['data'] = $customer;
        }
        catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
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
        $customer = new Customer;
        $customer->firstname = $request->input('firstname');
        $customer->lastname = $request->input('lastname');
        $customer->email = $request->input('email');
        $customer->phone_number = $request->input('phone_number');
        $result = $customer->save();

        $sms_body = $request->input('sms_body');
        $email_body = $request->input('email_body');

        if($result == 1)
        {       
            $this->dispatch(new JobEmail($customer->email, $email_body));
            $this->dispatch(new JobSms($customer->phone_number, $sms_body));
            
            return "Customer added successfully.";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $result = $customer->update($request->all());
        
        $sms_body = $request->input('sms_body');
        $email_body = $request->input('email_body');

        if($result == 1)
        {
            $this->dispatch(new JobEmail($customer->email, $email_body));
            $this->dispatch(new JobSms($customer->phone_number, $sms_body));

            return "Customer updated successfully.";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        $result = $customer->delete($id);

        $message = "Your account has been deleted!";

        if($result == 1)
        {
            $this->dispatch(new JobEmail($customer->email, $message));
            $this->dispatch(new JobSms($customer->phone_number, $message));
            
            return "Customer deleted successfully.";
        }
    }

    public function sendSMSNexmo()
    {
        Nexmo::message()->send([
            'to' => '639457755502',
            'from' => 'Harn',
            'text' => 'Thank you for joining us.'
        ]);
    }

    public function sendSMSTwilio()
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $appSid     = config('app.twilio')['TWILIO_APP_SID'];
        $client = new Client($accountSid, $authToken);
        try{
            // Use the client to do fun stuff like send text messages!
            $client->messages->create(
            // the number you'd like to send the message to
                '+639457755502',
           array(
                 // A Twilio phone number you purchased at twilio.com/console
                 'from' => '+12055484309',
                 // the body of the text message you'd like to send
                 'body' => 'Hey Harn! It’s good to see you after long time!'
             )
         );
        }
        catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }
}
