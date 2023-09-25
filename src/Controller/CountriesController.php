<?php

namespace App\Controller;

use App\Dto\CountryDto;
use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CountriesController extends AbstractController
{
    #[Route('/countries', name: 'app_countries')]
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $countries = $em->getRepository(Country::class)->findAll();
        return $this->json($countries, 200, [], ['groups' => 'country']);
    }

    #[Route('/countries/{id}', name: 'app_countries_show')]
    public function show(int $id, EntityManagerInterface $em): JsonResponse
    {
        $country = $em->getRepository(Country::class)->find($id);
        if (!$country) return $this->json(['error' => 'Country not found', 'status_code' => 404], 404);
        return $this->json($country, 200, [], ['groups' => 'country']);
    }

    #[Route('/countries', name: 'app_countries_create', methods: ['POST'])]
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        $countryDto = $serializer->deserialize($request->getContent(), CountryDto::class, 'json');
        $errors = $validator->validate($countryDto);
        if (count($errors) > 0) return $this->json($errors, 400);
        $country = new Country();
        $country->setName($countryDto->name);
        $em->persist($country);
        $em->flush();
        return $this->json($country, 201, [], ['groups' => 'country']);
    }

    #[Route('/countries/{id}', name: 'app_countries_update', methods: ['PUT'])]
    public function update(int $id, Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        $countryDto = $serializer->deserialize($request->getContent(), CountryDto::class, 'json');
        $errors = $validator->validate($countryDto);
        if (count($errors) > 0) return $this->json($errors, 400);
        $country = $em->getRepository(Country::class)->find($id);
        if (!$country) return $this->json(['error' => 'Country not found', 'status_code' => 404], 404);
        $country->setName($countryDto->name);
        $em->flush();
        return $this->json($country, 200, [], ['groups' => 'country']);
    }

    #[Route('/countries/{id}', name: 'app_countries_delete', methods: ['DELETE'])]
    public function delete(int $id, EntityManagerInterface $em): JsonResponse
    {
        $country = $em->getRepository(Country::class)->find($id);
        if (!$country) return $this->json(['error' => 'Country not found', 'status_code' => 404], 404);
        $em->remove($country);
        $em->flush();
        return $this->json(null, 204);
    }
}
