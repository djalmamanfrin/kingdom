<?php

namespace App\Console\Commands;

use App\Models\Service;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ManualInsertionOfServiceInElasticSearchCommand extends Command
{
    /** @var string The console command name */
    protected $signature = "elastic:manual-insertion-of-services";

    /** @var string The console command description */
    protected $description = "Manual insertion od service in data base by csv file";

    public function handle(Client $elastic)
    {
        $services = Service::query()->get();
        $this->info('Indexing all services. Might take a while...');
        $services->each(function ($service) use ($elastic) {
            /** @var Service $service */
            try {
                $elastic->index([
                    'index' => $service->getElasticsearchIndex(),
                    'id' => $service->id,
                    'body' => $service->getData(),
                ]);
            } catch (\Exception $e) {
                dd($elastic->transport->getLastConnection()->getLastRequestInfo());
            }
            // PHPUnit-style feedback
            $this->output->write('.');

        });
        $this->info("nDone!");
    }

}
