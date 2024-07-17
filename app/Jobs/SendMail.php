<?php

namespace App\Jobs;
use App\Mail\OrderShipped;
use App\Models\Carts;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $email;
    protected $carts;
    protected $customer_id;
    public function __construct($email, $customer_id)
    {
        //
        $this->email = $email;
        // $this->carts = $carts;
        $this->customer_id = $customer_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        $customer = Customer::findOrFail($this->customer_id);
        $orders = Carts::where('customer_id', $customer->id)->get();
        //
        Mail::to($this->email)->send(new OrderShipped($orders,$customer));
    }
}
