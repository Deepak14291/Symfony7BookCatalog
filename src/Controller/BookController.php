<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BookType;
use App\Repository\BooksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    #[Route('/books', name: 'app_book')]
    public function index(BooksRepository $books): Response
    {
        return $this->render('book/index.html.twig', [
            'books' => $books->findAll(),
        ]);
    }

    #[Route('/book/add', name: 'add_newbook')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BookType::class, new Books());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();
            $entityManager->persist($book);
            // dd($student);
            $entityManager->flush();

            $this->addFlash('Success', 'Book information successfully saved to database');

            return $this->redirectToRoute('app_book');
        }

        return $this->render(
            'book/add.html.twig',
            [
                'form' => $form
            ]
        );
    }

    #[Route('/book/{id}/update', name: 'update_book')]
    public function update(Books $book, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();
            $entityManager->persist($book);
            // dd($student);
            $entityManager->flush();

            $this->addFlash('Success', 'Book information successfully updated to database');

            return $this->redirectToRoute('app_book');
        }

        return $this->render(
            'book/update.html.twig',
            [
                'form' => $form
            ]
        );
    }

    #[Route('/book/{id}/delete', name: 'delete_book')]
    public function delete(Books $book, Request $request, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($book);
        $entityManager->flush();
        return $this->redirectToRoute('app_book');
    }
}