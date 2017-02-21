<?php
namespace PhotoApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileControllerTest
 * @package PhotoApiBundle\Tests\Controller
 */
class FileControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            '/file/list',
            [
                '1', '50'
            ]
        );
        $this->assertContains('{"0":"test.jpeg","test.jpeg":["tag1","tag2","tag3"]}', $client->getResponse()->getContent());

    }
    public function testAdd()
    {
        $testFileName = 'test';
        $tags = ['tag1', 'tag2', 'tag3'];

        $client = static::createClient();
        $path  = $client->getKernel()->getContainer()->getParameter('files_directory').'/test.jpeg';
        $original_name  = 'test.jpeg';
        $mime_type  = 'image/jpeg';
        $size  = 600;
        $error   = null;
        $test   = true;
        $testFile = new UploadedFile($path, $original_name, $mime_type, $size, $error, $test);

        $crawler = $client->request(
            'POST',
            '/file/add',
            [
                'file_name' => $testFileName,
                'tags' => $tags
            ],
            ['photo' =>$testFile]
        );
        $this->assertContains('{"Ok":"File was successfully added"}', $client->getResponse()->getContent());
    }

    public function testRemove()
    {
        $fileID = 30;
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            '/file/remove',
            [
                'fileId' => $fileID
            ]
        );
        $this->assertContains('{"0":"test.jpeg","test.jpeg":["tag1","tag2","tag3"]}', $client->getResponse()->getContent());

    }
}
