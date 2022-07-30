<?php

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ProductControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/product-added/19');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Product with name Test Product #5 Name was added.');
    }
}
