<?php

namespace Afandi\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'admin/category');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'admin/category/add');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'admin/category/edit/{id}');
    }

}
