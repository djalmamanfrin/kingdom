<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Console\Command;
use League\Csv\Reader;

class ManualInsertionOfServiceInDatabaseCommand extends Command
{
    /** @var string The console command name */
    protected $signature = "services:database-manual-insertion";

    /** @var string The console command description */
    protected $description = "Manual insertion od service in data base by csv file";

    public function handle()
    {
        $path = storage_path('docs/tabela-atividades-profissoes-permitidas-mei.csv');
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();
        $recordCount = iterator_count($records);
        $records->rewind();
        $values = [];
        while ($records->valid()) {
            print 'Line: ' . $records->key() . ' - ' . $recordCount . PHP_EOL;
            $min = 5;
            $max = 90; // max allowed in Database
            $pattern = sprintf('/[\w]{%s,%s}/', $min, $max);

            $record = $records->current();
            $string = $record['activity'] . ' ' . $record['description'];
            preg_match_all($pattern, $string, $tags);

            array_push($values, [
                'company_id' => Company::query()->pluck('id')->random(),
                'name' => $record['activity'],
                'description' => $record['description'],
                'tags' => implode(', ', current($tags))
            ]);
            $records->next();
        }
        Service::query()->insert($values);
    }

}
