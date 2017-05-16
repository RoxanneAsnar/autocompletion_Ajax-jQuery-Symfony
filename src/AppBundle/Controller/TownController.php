<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 15/05/17
 * Time: 10:30
 */

namespace AppBundle\Controller;

use AppBundle\Repository\townRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TownController extends Controller
{
    /**
     * @param Request $request
     * @param $town
     * @Route("/town/{town}")
     * @return JsonResponse
     */

    public function autocompleteAction(Request $request, $town)
    {
        if ($request->isXmlHttpRequest()){
            /**
             * @var $repository townRepository
             */

            $repository = $this->getDoctrine()->getRepository('AppBundle:town');
            $data = $repository->getTownLike('fr', $town);
            return new JsonResponse(array("data" => json_encode($data)));
        } else {
            throw new HttpException('500', 'Invalid call');
        }
    }
}