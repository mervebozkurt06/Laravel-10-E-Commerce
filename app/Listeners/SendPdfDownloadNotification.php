<?php

namespace App\Listeners;

use App\Events\DownloadPdfEvent;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPdfDownloadNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DownloadPdfEvent $event): void
    {
        $data = $event->getData();
        $orderId = $event->getOrderId();

        Storage::disk('local')->makeDirectory('/pdf/order');
        $pdf = PDF::loadView('order.samplePdf', $data);

        $fileName = $orderId . '.pdf';
        $pdf->save(public_path('/storage/pdf/order/'.$fileName));
    }
}
