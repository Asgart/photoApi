<?php
namespace PhotoApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class TagsControllerTest
 * @package PhotoApiBundle\Tests\Controller
 */
class TagsControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $tags = ['tag1', 'tag2', 'tag3'];

        $crawler = $client->request(
            'POST',
            '/tag/add/44',
            ['tags' => $tags]
        );

        $this->assertContains('{"Tags for file id#44 was added: ":["tag1","tag2"]}', $client->getResponse()->getContent());
    }
    public function testRemove()
    {
        $client = static::createClient();

        $tags = ['tag1', 'tag2', 'tag3'];

        $crawler = $client->request(
            'POST',
            '/tag/remove/44',
            ['tags' => $tags]
        );

        $this->assertContains('{"Tags from file id#44 was removed: ":["tag1","tag2","tag3"]}', $client->getResponse()->getContent());
    }

}