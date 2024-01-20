<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Avis;
use App\Form\CarType;
use App\Form\ImageType;
use App\Form\FormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;


class CarController  extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Car::class);

        $carD = $repository->findAll();//Seleclt * FROM 'post';


        $repository2 = $doctrine->getRepository(Avis::class);

        $avis = $repository2->findAll();//Seleclt * FROM 'post';

        return $this->render("/pages/index.html.twig", ["Car" => $carD, "Avis" => $avis]);

        
    }

    /**
     * @Route("/car/ajout")
     */
    public function CarAdd(Request $request, ManagerRegistry $doctrine):Response
    {   
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /**Fil
             */
            $file = $car->getImageFile();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('upload_directory'), 
                $fileName
            );
    
            $car->setImageFilename($fileName);
    
            /**/ 
            $em = $doctrine->getManager();
            $em->persist($car);
            $em->flush();
            return $this->redirectToRoute("home");
        }
        return $this->render('/car/form.html.twig', [
            "CarForm" => $form->createView()
        ]);

    }
  

   /**
 * @Route("/car", name="car_display")
 */
public function CarsSell(ManagerRegistry $doctrine, Request $request): Response
{
    $repository = $doctrine->getRepository(Car::class);

    // Fetch all cars for initial display
    $cars = $repository->findAll();

    // Filter options
    $brands = $repository->findDistinctBrands();
    $models = $repository->findDistinctModels();

    // Create the search form
    $form = $this->createForm(SearchType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // If the form is submitted, fetch cars based on filters
        $data = $form->getData();
        $selectedBrand = $data['brand'];
        $selectedModel = $data['model'];

       
        $cars = $repository->findByFilters($selectedBrand, $selectedModel);
    }

    return $this->render('/pages/cars-sell.html.twig', [
        'brands' => $brands,
        'models' => $models,
        'cars' => $cars,
        'form' => $form->createView(),
    ]);
}

    }
    


