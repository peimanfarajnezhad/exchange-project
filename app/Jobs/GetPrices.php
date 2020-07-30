<?php

namespace App\Jobs;

use App\Repositories\Interfaces\PriceRepositoryInterface;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class GetPrices implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $priceRepository = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PriceRepositoryInterface $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Http::fake([
            'http://peiman.local/prices' => Http::response([
                ['abbr' => 'IRR', 'price' => 1],
                ['abbr' => 'USD', 'price' => rand(1, 25)],
                ['abbr' => 'EUR', 'price' => rand(1, 25)],
            ], 200)
        ]);

        try {
            $response = Http::get('http://peiman.local/prices')->throw();
            $this->priceRepository->createMultiple($response->json());
        } catch (Exception $e) {
            // TODO log the error
            // do nothing here.
        }
    }
}
