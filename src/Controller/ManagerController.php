<?php


namespace App\Controller;

use App\Entity\Manager;
use App\Repository\ManagerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ManagerController extends ApiController
{
    /**
     * @Route("/managers", methods="GET")
     */
    public function index(ManagerRepository $managerRepository)
    {
        $managers = $managerRepository->transformAll();

        return $this->respond($managers);
    }

    /**
     * @Route("/managers", methods="POST")
     */
    public function create(Request $request, ManagerRepository $managerRepository, EntityManagerInterface $em)
    {
        $request = $this->transformJsonBody($request);
        if (! $request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        // validate the title
        if (! $request->get('username')) {
            return $this->respondValidationError('Please provide a username!');
        }

        // persist the new manager
        $manager = new Manager;
        $manager->setFirstName($request->get('first_Name'));
        $manager->setLastname($request->get('last_Name'));
        $manager->setUsername($request->get('username'));
        $manager->setPassword($request->get('password'));
        $em->persist($manager);
        $em->flush();

        return $this->respondCreated($managerRepository->transform($manager));
    }

    /**
     * @Route("/managers/{id}", methods="Get")
     */
    public function increaseCount($id, ManagerRepository $managerRepository)
    {
        $manager = $managerRepository->find($id);

        if (! $manager) {
            return $this->respondNotFound();
        }

        $result = $managerRepository->transform($manager);

        return $this->respond($result);

    }

}