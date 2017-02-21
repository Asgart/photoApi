<?php
/**
 * Created by PhpStorm.
 * User: vad
 * Date: 19.02.17
 * Time: 10:34
 */

namespace PhotoApiBundle\Controller;

use PhotoApiBundle\Entity\FileTag;
use PhotoApiBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TagsController
 * @package PhotoApiBundle\Controller
 */
class TagsController extends Controller
{
    /**
     * @param Request $request
     * @param int $fileId
     * @return JsonResponse
     */
    public function addAction(Request $request, $fileId = 0)
    {
        try {

            $params = (array)$request->request->all();
            $em = $this->getDoctrine()->getManager();
            $date = new \DateTime("now");
            $adder = 'user';
            $added = $date;
            $modifier = 'user';
            $modified = $date;
            $responseTags = [];
            $params['tags'] = ['tag1', 'tag2'];

            if (count($params) < 1 || !isset($params['tags']) || count($params['tags']) < 1) {
               // throw new \Exception('No parameters');
            }
            if ($fileId <= 0) {
              //  throw new \Exception('File id not set');
            }

            $repository = $em->getRepository('PhotoApiBundle:File');
            $file = $repository->find($fileId);

            if (!$file) {
               // throw new \Exception('File not found');
            }

            $repository = $em->getRepository('PhotoApiBundle:Tag');
            $fileTagRepository = $em->getRepository('PhotoApiBundle:FileTag');
            foreach ($params['tags'] as $tagValue) {
                $tag = $repository->findOneByName($tagValue);
                $responseTags[] = $tagValue;
                if (!$tag) {
                    $tag = new Tag();
                    $tag->setName($tagValue);
                    $tag->setAdded($added);
                    $tag->setAdder($adder);
                    $tag->setModified($modified);
                    $tag->setModifier($modifier);
                    $tag->setGhost(false);
                    $em->persist($tag);
                    $em->flush();
                }

                $fileTag = $fileTagRepository->findOneBy(['tag' => $tag, 'file' => $file]);
                if ($fileTag) {
                    continue;
                }
                $fileTag = new FileTag();
                $fileTag->setFile($file);
                $fileTag->setTag($tag);
                $em->persist($fileTag);
                $em->flush();
            }

            return new JsonResponse(['Tags for file id#' . $fileId . ' was added: ' => $responseTags]);

        } catch (\Exception $e) {
            return new JsonResponse(['Error' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @param int $fileId
     * @return JsonResponse
     */
    public function removeAction(Request $request, $fileId = 0)
    {
        try {
            $params = (array)$request->request->all();
            $responseTags = [];
            $em = $this->getDoctrine()->getManager();
            if (count($params) < 1 || !isset($params['tags']) || count($params['tags']) < 1) {
                throw new \Exception('No parameters');
            }
            if ($fileId <= 0) {
                throw new \Exception('File id not set');
            }
            $repository = $em->getRepository('PhotoApiBundle:File');
            $file = $repository->find($fileId);

            if (!$file) {
                throw new \Exception('File not found');
            }

            $tagRepository = $em->getRepository('PhotoApiBundle:Tag');
            $fileTagRepository = $em->getRepository('PhotoApiBundle:FileTag');
            foreach ($params['tags'] as $tagValue) {
                $responseTags[] = $tagValue;
                $tag = $tagRepository->findOneByName($tagValue);
                if ($tag) {
                    $fileTag = $fileTagRepository->findOneBy(['tag' => $tag, 'file' => $file]);
                    if ($fileTag) {
                        $em->remove($fileTag);
                        $em->flush();
                    }
                } else {
                    continue;
                }
            }

            $response = new JsonResponse(['Tags from file id#' . $fileId . ' was removed: ' => $responseTags]);

        } catch (\Exception $e) {
            $response = new JsonResponse(['Error' => $e->getMessage()]);
        } finally {
            return $response;
        }
    }
}