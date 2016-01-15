<?php

namespace Afandi\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'admin/blog');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'admin/blog/add');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'admin/blog/edit/{id}');
    }

}
