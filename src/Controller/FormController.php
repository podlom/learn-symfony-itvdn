<?php

namespace App\Controller;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Form\PostType;
use App\Entity\Product;


class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $post = new Product();
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $product = $form->getData();
            $entityManager->persist($product);
            $entityManager->flush();

            return new RedirectResponse('/product-added/' . $product->getId());
        }

        return $this->render('form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/product-encoder/{format}', name: 'app_product_encoder')]
    public function productEncoder(Request $request, string $format = 'json'): Response
    {
        $post = new Product();
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $encoders = [new JsonEncoder(), new XmlEncoder()];
            $normalizers = [new ObjectNormalizer()];
            $serializer = new Serializer($normalizers, $encoders);

            if ($format === 'json') {
                $jsonContent = $serializer->serialize($product, 'json');
                return new Response($jsonContent);
            } else {
                $xmlContent = $serializer->serialize($product, 'xml');
                return new Response($xmlContent);
            }
        }

        return $this->render('form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
