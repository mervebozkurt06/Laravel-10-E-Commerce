<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use http\Env\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;
    public $maxExceptions = 1;


    private $request;
    private $userId;

    /**
     * Create a new job instance.
     */
    public function __construct(array $request)
    {
        $this->request = $request;
        $this->userId = auth()->id();
        $this->onQueue('queue_order');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();
        try {
            $data = new Order();
            $data->name = $this->request['name'];
            $data->surname = $this->request['surname'];
            $data->user_id = $this->userId;
            $data->email = $this->request['email'];
            $data->phone = $this->request['phone'];
            $data->address = $this->request['address'];
            $data->total = $this->request['total'];
            $data->save();

            $datalist = Cart::where('user_id', '=', $this->userId)->get();
            foreach ($datalist as $rs) {
                $orderItem = new OrderProduct();
                $orderItem->user_id = $this->userId;
                $orderItem->product_id = $rs->product_id;
                $orderItem->order_id = $data->id;
                $orderItem->price = intval($rs->product->price);
                $orderItem->quantity = intval($rs->quantity);
                $orderItem->total = intval($rs->quantity) * intval($rs->product->price);
                $orderItem->save();

            }

            $oldCart = Cart::where('user_id', '=', $this->userId)->get();
            foreach ($oldCart as $old) {
                $old->delete();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->failed();
        }

    }

    public function failed($exception)
    {
        $exception->getMessage();

    }
}
