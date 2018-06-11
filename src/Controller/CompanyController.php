<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Company;

class CompanyController extends Controller
{
    /**
     * Find all companies
     *
     * @Rest\View(serializerGroups={"company"})
     * @Rest\Get("/companies")
     */
    public function getCompaniesAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$companies = $em->getRepository(Company::class)->findAll();

    	return $companies;
    }

    /**
     * Find a single company
     *
     * @Rest\View(serializerGroups={"company"})
     * @Rest\Get("/companies/{id}")
     */
    public function getCompanyAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$company = $em->getRepository(Company::class)->find($request->get('id'));

    	if (empty($company)) {
    		return new JsonResponse(['message' => 'Company not found'], Response::HTTP_NOT_FOUND);
    	}

    	return $company;
    }
}
