<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
    $category = $categoryRepository->findAll();

    return $this->render('category/index.html.twig', [
        'categories' => $category,
    ]);
    }

    #[Route('/{categoryName}', methods: ['GET'], name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findOneBy(['name'=>$categoryName]);
        $programs = $programRepository->findBy(['category'=>$category], ['id'=>'DESC'], 3);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category found in category table'
            );
        }
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs
        ]);

    }
}