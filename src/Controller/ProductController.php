<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\RandGenerator;
use App\Entity\Product;


class ProductController extends AbstractController
{
    #[Route('/add-product', name: 'app_add_product')]
    public function make(ManagerRegistry $doctrine, RandGenerator $randomGenerator): Response
    {
        $entityManager = $doctrine->getManager();
        $randomNumber = $randomGenerator->randomNumber(21, 91);

        $product = new Product();
        $product->setName('Test Product With a Price ' . $randomNumber);
        $product->setDescription('Test Product with a price ' . $randomNumber . ' description text goes here...');
        $product->setPrice($randomNumber);
        $product->setAuthor('Taras from ProductController::make');
        $product->setSku('S019-' . $randomNumber);

        $entityManager->persist($product);
        $entityManager->flush();

        $msg = 'Saved a new product with ID: ' . $product->getId();

        return $this->render('product/make.html.twig', [
            'controller_name' => 'ProductController',
            'message' => $msg,
        ]);
    }

    /**
     * @Route("/product/{id}", name="app_display_product")
     */
    public function displayProduct($id, ManagerRegistry $doctrine): Response
    {
        $product = $doctrine->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product with id ' . $id . ' found.'
            );
        }

        return $this->render('product/display.html.twig', [
            'title' => $product->getName(),
            'product' => $product,
        ]);
    }
}
