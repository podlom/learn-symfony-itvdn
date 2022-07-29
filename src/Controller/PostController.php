<?php

namespace App\Controller;


use App\Service\RandGenerator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Post;


class PostController extends AbstractController
{
    #[Route('/posts', name: 'app_posts_index')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    #[Route('/add-post', name: 'app_add_post')]
    public function addPost(ManagerRegistry $doctrine, RandGenerator $randomGenerator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'To access /add-post you should have ROLE_ADMIN granted');

        $entityManager = $doctrine->getManager();
        $randomNumber = $randomGenerator->randomNumber(101, 909);

        $category = new Category();
        $category->setName('Art');

        $post = new Post();
        $post->setTitle('Test Post Title #' . $randomNumber);
        $post->setDescription('Test Post #' . $randomNumber . ' Descripion');
        $post->setAuthor('Taras');
        $post->setCategory($category);

        $entityManager->persist($category);
        $entityManager->persist($post);
        $entityManager->flush();

        return $this->render('post/add.html.twig', [
            'category' => $category,
            'post' => $post,
        ]);
    }
}
