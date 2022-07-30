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
}
