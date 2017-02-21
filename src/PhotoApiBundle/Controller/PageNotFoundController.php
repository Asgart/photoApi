<?php

namespace PhotoApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class PageNotFoundController
 * @package PhotoApiBundle\Controller
 */
class PageNotFoundController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function pageNotFoundAction(Request $request)
    {
       return new JsonResponse(['Error' => 'API parameters not found']);

    }

}