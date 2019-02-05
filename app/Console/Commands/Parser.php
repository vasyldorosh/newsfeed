<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Parser\ParserFactory;
use App\Services\Parser\Parser as ParserHelper;
use App\Repositories\Eloquent\NewsRepo;

class Parser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'parser';

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
     * @return mixed
     */
    public function handle()
    {
        foreach (ParserHelper::getUrls() as $url => $resourceClass) {
            
            echo $url . "\n";
            
            ParserFactory::build($resourceClass)->setUrl($url)->parse();
        }
    }
}
