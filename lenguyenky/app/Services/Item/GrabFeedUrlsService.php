<?php

namespace App\Services\Item;

use App\Repositories\ChannelRepository;
use App\Repositories\ImageRepository;
use App\Repositories\ItemRepository;
use Ky\Core\Services\BaseService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class GrabFeedUrlsService extends BaseService
{
    protected $collectsData = true;

    /**
     * @var \App\Repositories\ChannelRepository
     */
    protected $channelRepository;

    /**
     * @var \App\Repositories\ImageRepository
     */
    protected $imageRepository;

    /**
     * @var \App\Repositories\ItemRepository
     */
    protected $itemRepository;

    public function __construct(
        ChannelRepository $channelRepository,
        ItemRepository $itemRepository,
        ImageRepository $imageRepository
    ) {
        $this->channelRepository = $channelRepository;
        $this->itemRepository = $itemRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $result = $this->grab();

        return DB::transaction(function() use ($result) {
            // Insert chancel
            $channel = $this->channelRepository->create($this->transformChannel((array) $result->channel));

            // Insert Image
            $this->imageRepository->create($this->transformImage((array) $result->channel, $channel->id));

            // Insert bulk items
            return $this->itemRepository->insert($this->transformItems((array) $result->channel, $channel->id));
        });
    }


    /**
     * Frab from feed url
     *
     * @return SimpleXMLElement
     */
    private function grab()
    {
        $this->client = new Client();
        $response = $this->client->get($this->data->get('url'));

        return simplexml_load_string($response->getBody()->getContents());
    }


    /**
     * Transform data channel
     *
     * @param array $result
     *
     * @return array
     */
    private function transformChannel(array $result)
    {
        return [
            'title' => $result['title'],
            'description' => $result['description'],
            'link' => $result['link'],
            'category' => $result['category'],
            'copyright' => $result['copyright'],
            'docs' => $result['docs'],
            'language' => $result['language'],
            'lastBuildDate' => $result['lastBuildDate'],
            'managingEditor' => $result['managingEditor'],
            'pubDate' => $result['pubDate'],
            'webMaster' => $result['webMaster'],
            'generator' => $result['generator']
        ];
    }

    /**
     * Transform data items
     *
     * @param array $result
     * @param int $channelId
     *
     * @return array
     */
    private function transformImage(array $result, int $channelId)
    {
        $image = (array) $result['image'];
        $image['channel_id'] = $channelId;

        return $image;
    }

    /**
     * Transform data items
     *
     * @param array $result
     * @param int $channelId
     *
     * @return array
     */
    private function transformItems(array $result, int $channelId)
    {
        $items = [];
        $now = now();

        foreach($result['item'] as $value) {
            $item = (array) $value;
            $items[] = [
                'channel_id' => $channelId,
                'title' => $item['title'],
                'description' => $item['description'],
                'link' => $item['link'],
                'category' => $item['category'],
                'comments' => $item['comments'],
                'pubDate' => $item['pubDate'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        return $items;
    }
}
