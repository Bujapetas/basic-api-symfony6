<?php

namespace App\Controller;

use App\Dto\GenreDto;
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GenresController extends AbstractController
{
    #[Route('/genres', name: 'app_genres')]
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $genres = $em->getRepository(Genre::class)->findAll();
        return $this->json($genres, 200, [], ['groups' => 'genre']);
    }

    #[Route('/genres/{id}', name: 'app_genres_show')]
    public function show(int $id, EntityManagerInterface $em): JsonResponse
    {
        $genre = $em->getRepository(Genre::class)->find($id);
        if (!$genre) return $this->json(['error' => 'Genre not found', 'status_code' => 404], 404);
        return $this->json($genre, 200, [], ['groups' => 'genre']);
    }

    #[Route('/genres', name: 'app_genres_create', methods: ['POST'])]
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        $genreDto = $serializer->deserialize($request->getContent(), GenreDto::class, 'json');
        $errors = $validator->validate($genreDto);
        if (count($errors) > 0) return $this->json($errors, 400);
        $genre = new Genre();
        $genre->setName($genreDto->name);
        $em->persist($genre);
        $em->flush();
        return $this->json($genre, 201, [], ['groups' => 'genre']);
    }

    #[Route('/genres/{id}', name: 'app_genres_update', methods: ['PUT'])]
    public function update(int $id, Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        $genreDto = $serializer->deserialize($request->getContent(), GenreDto::class, 'json');
        $errors = $validator->validate($genreDto);
        if (count($errors) > 0) return $this->json($errors, 400);
        $genre = $em->getRepository(Genre::class)->find($id);
        if (!$genre) return $this->json(['error' => 'Genre not found', 'status_code' => 404], 404);
        $genre->setName($genreDto->name);
        $em->flush();
        return $this->json($genre, 200, [], ['groups' => 'genre']);
    }

    #[Route('/genres/{id}', name: 'app_genres_delete', methods: ['DELETE'])]
    public function delete(int $id, EntityManagerInterface $em): JsonResponse
    {
        $genre = $em->getRepository(Genre::class)->find($id);
        if (!$genre) return $this->json(['error' => 'Genre not found', 'status_code' => 404], 404);
        $em->remove($genre);
        $em->flush();
        return $this->json($genre, 200, [], ['groups' => 'genre']);
    }
}
