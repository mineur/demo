<?php

namespace DataNormalizer\Application;

use DataNormalizer\Domain\Model\Post;
use SqsPhpBundle\Client\Client;

/**
 * Class SqsEnqueue
 *
 * @package Bundle\Services
 */
class EnqueueNormalizedPost
{
    /**
     * @var Client
     */
    private $sqsClient;
    
    /**
     * SqsEnqueue constructor.
     *
     * @param $sqsClient
     */
    public function __construct(Client $sqsClient)
    {
        $this->sqsClient = $sqsClient;
    }
    
    /**
     * @param Post $post
     */
    public function enqueue(Post $post)
    {
        $this->sqsClient->send(
            'normalized_posts_queue',
            $post->toJson()
        );
    }
}