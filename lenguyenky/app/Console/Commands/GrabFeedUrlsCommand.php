<?php

namespace App\Console\Commands;

use App\Models\Channel;
use App\Services\Item\GrabFeedUrlsService;
use Illuminate\Console\Command;

class GrabFeedUrlsCommand extends Command
{
/**
     * The name and signature of the console command.
     * https://www.feedforall.com/sample.xml
     *
     * @var string
     */
    protected $signature = 'feed:urls {urls?} {--log=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Accepts the feed urls';

    /**
     * @var string
     */
    protected $urls;

    /**
     * @var GrabFeedUrlsService
     */
    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GrabFeedUrlsService $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->setLog();

        $urls = $this->getAllArguments();

        if (empty($urls)) {
            $this->error('Enter the urls you want to grab');
            return;
        }

        foreach ($urls as $url) {
            if (! $this->ensureHttp($url)) {
                $this->comment($url . ' is not a https !!');
                continue;
            }

            try {
                $this->service->setData(['url' => $url])->handle();

                $info = 'Grab ' . $url . ' successfully !!!';
                \Log::info($info);
                $this->info($info);
            } catch (\Exception $e) {
                $this->error('Grab ' . $url . ' failed !!!');
            }
        }

        $this->info('Grab feed urls done !!!');
    }

    /**
     * Get all arguments
     *
     * @return array
     */
    private function getAllArguments()
    {
        return $this->argument('urls')
            ? explode(',', $this->argument('urls'))
            : [];
    }

    /**
     * Check the url ensure the https
     *
     * @param string $url
     *
     * @return bool
     */
    private function ensureHttp($url)
    {
        return preg_match(Channel::HTTP_REGEX, $url);
    }


    /**
     * Custom log
     */
    private function setLog()
    {
        if (!is_null($this->option('log'))) {
            config(['logging.channels.custom.path' => storage_path('logs/' . $this->option('log') . '.log')]);
        }
    }
}
