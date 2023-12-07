<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
    $category = $categoryRepository->findAll();

    return $this->render('category/index.html.twig', [
        'categories' => $categoryName,
    ]);
    }

    #[Route('/{categoryName}', methods: ['GET'], name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findBy();

        if (!$category) {
            throw $this->createNotFoundException(
                'No category found in category table'
            );
        }
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }
}