<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Service\RandGenerator;


class AppProductFixtures extends Fixture
{
    const NUM_PRODUCTS = 15;

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= self::NUM_PRODUCTS; $i++) {
            $randGenerator = new RandGenerator();
            $number1 = $randGenerator->randomNumber(111, 999);
            /** @var Product $product1 */
            $product1 = new Product();
            $product1->setName('Test Product #' . $i . ' Name');
            $product1->setSku('S029-' . $i . '-' . $number1);
            $product1->setDescription('Test Product #' . $i . ' Description');
            $product1->setPrice($number1);
            $product1->setAuthor('Taras from Fixtures');
            $manager->persist($product1);
            $manager->flush();
        }
    }
}
