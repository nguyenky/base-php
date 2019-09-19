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

        return DB::transaction(function () use ($result) {
            // Insert chancel
            $channel = $this->channelRepository->create($this->transformChannel((array) $result->channel));

            // Insert Image
            $this->imageRepository->create($this->transformImage((array) $result->channel, $channel->id));

            // Insert bulk items
            $this->itemRepository->insert($this->transformItems((array) $result->channel, $channel->id));
            
            return $channel;
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
            'title' => $result['title'] ?? null,
            'description' => $result['description'] ?? null,
            'link' => $result['link'] ?? null,
            'category' => $result['category'] ?? null,
            'copyright' => $result['copyright'] ?? null,
            'docs' => $result['docs'] ?? null,
            'language' => $result['language'] ?? null,
            'lastBuildDate' => $result['lastBuildDate'] ?? null,
            'managingEditor' => $result['managingEditor'] ?? null,
            'pub_date' => $result['pubDate'] ?? null,
            'webMaster' => $result['webMaster'] ?? null,
            'generator' => $result['generator'] ?? null
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

        foreach ($result['item'] as $value) {
            $item = (array) $value;
            $items[] = [
                'channel_id' => $channelId,
                'title' => $item['title'] ?? null,
                'description' => $item['description'] ?? null,
                'link' => $item['link'] ?? null,
                'category' => $item['category'] ?? null,
                'comments' => $item['comments'] ?? null,
                'pub_date' => $item['pubDate'] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        return $items;
    }
}
