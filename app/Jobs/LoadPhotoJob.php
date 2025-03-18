<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LoadPhotoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->data;
        if (!isset($data[2]) || !isset($data[0])) return;
        $product = Product::where('code', $data[2])->first();
        if (!$product) return;

        $photos = collect(explode(';', $data[0]));
        if ($photos->isEmpty()) return;

        $product->addMediaFromUrl(str_replace(' ', '%20', $photos[0]))->toMediaCollection('cover');
        foreach ($photos as $img) {
            $url = str_replace(' ', '%20', $img);
            $product->addMediaFromUrl($url)->toMediaCollection('photos');
        }
    }
}
