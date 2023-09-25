<?php

namespace App\Controller;

use App\Dto\MovieDto;
use App\Entity\Country;
use App\Entity\Genre;
use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'app_movies', methods: ['GET'])]
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $movies = $em->getRepository(Movie::class)->findAll();
        return $this->json($movies, 200, [], ['groups' => 'movie']);
    }

    //Hacer una llamada de paginación que por query param obtenermos el numero iniciar y el numero final
    #[Route('/movies/pagination', name: 'app_movies_pagination', methods: ['GET'])]
    public function pagination(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $page = $request->query->get('page',1);
        if($page < 1) return $this->json(['error' => 'Page not found', 'status_code' => 404], 404);
        $movies = $em->getRepository(Movie::class)->findBy([], null, 5, $page-1);
        if (!$movies) return $this->json(['error' => 'Movies not found', 'status_code' => 404], 404);
        return $this->json($movies, 200, [], ['groups' => 'movie']);
    }

    #[Route('/movies/{id}', name: 'app_movies_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $em): JsonResponse
    {
        $movie = $em->getRepository(Movie::class)->find($id);
        if (!$movie) return $this->json(['error' => 'Movie not found', 'status_code' => 404], 404);
        return $this->json($movie, 200, [], ['groups' => 'movie']);
    }

    #[Route('/movies/by-genre/{genre}', name: 'app_movies_by_genre', methods: ['GET'])]
    public function byGenre(string $genre, EntityManagerInterface $em): JsonResponse
    {
        $movies = $em->getRepository(Movie::class)->findBy(['genre' => $genre]);
        if (!$movies) return $this->json(['error' => 'Movies not found', 'status_code' => 404], 404);
        return $this->json($movies, 200, [], ['groups' => 'movie']);
    }

    #[Route('/movies/by-country/{country}', name: 'app_movies_by_country', methods: ['GET'])]
    public function byCountry(string $country, EntityManagerInterface $em): JsonResponse
    {
        $movies = $em->getRepository(Movie::class)->findBy(['country' => $country]);
        if (!$movies) return $this->json(['error' => 'Movies not found', 'status_code' => 404], 404);
        return $this->json($movies, 200, [], ['groups' => 'movie']);
    }

    #[Route('/movies/by-genre-and-country/{genre}/{country}', name: 'app_movies_by_genre_and_country', methods: ['GET'])]
    public function byGenreAndCountry(string $genre, string $country, EntityManagerInterface $em): JsonResponse
    {
        $movies = $em->getRepository(Movie::class)->findBy(['genre' => $genre, 'country' => $country]);
        if (!$movies) return $this->json(['error' => 'Movies not found', 'status_code' => 404], 404);
        return $this->json($movies, 200, [], ['groups' => 'movie']);
    }

    #[Route('/movies', name: 'app_movies_create', methods: ['POST'])]
    public function createMovie(Request $request, ValidatorInterface $validator, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse
    {
        $movieDTO = $serializer->deserialize($request->getContent(), MovieDTO::class, 'json');
        $errors = $validator->validate($movieDTO);

        if (count($errors) > 0) {
            return $this->json($errors, 400);
        } else {

            $genre = $em->getRepository(Genre::class)->find($movieDTO->genre);
            if (!$genre) return $this->json(['error' => 'Genre not found', 'status_code' => 404], 404);
            $country = $em->getRepository(Country::class)->find($movieDTO->country);
            if (!$country) return $this->json(['error' => 'Country not found', 'status_code' => 404], 404);

            $movie = new Movie();
            $movie->setTitle($movieDTO->title)
                ->setDescription($movieDTO->description)
                ->setRuntime($movieDTO->runtime)
                ->setBudget($movieDTO->budget)
                ->setPoster($movieDTO->poster == null ? 'https://via.placeholder.com/300x400.png?text=No+Image' : $movieDTO->poster)
                ->setReleaseDate($movieDTO->release_date)
                ->setGenre($genre)
                ->setContry($country);

            $em->persist($movie);
            $em->flush();

            return $this->json($movie, 201, [], ['groups' => 'movie']);
        }
    }

    #[Route('/movies/{id}', name: 'app_movies_update', methods: ['PUT'])]
    public function updateMovie(int $id, Request $request, ValidatorInterface $validator, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse
    {
        $movieDTO = $serializer->deserialize($request->getContent(), MovieDTO::class, 'json');
        $errors = $validator->validate($movieDTO);

        if (count($errors) > 0) {
            return $this->json($errors, 400);
        } else {

            $movie = $em->getRepository(Movie::class)->find($id);
            if (!$movie) return $this->json(['error' => 'Movie not found', 'status_code' => 404], 404);

            $genre = $em->getRepository(Genre::class)->find($movieDTO->genre);
            if (!$genre) return $this->json(['error' => 'Genre not found', 'status_code' => 404], 404);
            $country = $em->getRepository(Country::class)->find($movieDTO->country);
            if (!$country) return $this->json(['error' => 'Country not found', 'status_code' => 404], 404);

            $movie->setTitle($movieDTO->title)
                ->setDescription($movieDTO->description)
                ->setRuntime($movieDTO->runtime)
                ->setBudget($movieDTO->budget)
                ->setPoster($movieDTO->poster == null ? 'https://via.placeholder.com/300x400.png?text=No+Image' : $movieDTO->poster)
                ->setReleaseDate($movieDTO->release_date)
                ->setGenre($genre)
                ->setContry($country);

            $em->persist($movie);
            $em->flush();

            return $this->json($movie, 200, [], ['groups' => 'movie']);
        }
    }

    #[Route('/movies/{id}', name: 'app_movies_delete', methods: ['DELETE'])]
    public function deleteMovie(int $id, EntityManagerInterface $em): JsonResponse
    {
        $movie = $em->getRepository(Movie::class)->find($id);
        if (!$movie) return $this->json(['error' => 'Movie not found', 'status_code' => 404], 404);
        $em->remove($movie);
        $em->flush();
        return $this->json($movie, 200, [], ['groups' => 'movie']);
    }
}
