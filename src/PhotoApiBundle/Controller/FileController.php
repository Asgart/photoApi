<?php
namespace PhotoApiBundle\Controller;

use PhotoApiBundle\Entity\File;
use PhotoApiBundle\Entity\FileTag;
use PhotoApiBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FileController
 * @package PhotoApiBundle\Controller
 */
class FileController extends Controller
{
    const MIMELIST = [
        'image/gif',
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/svg+xml',
        'image/tiff',
        'image/vnd.microsoft.icon',
        'image/vnd.wap.wbmp',
        'image/webp',
    ];

    /**
     * List files function
     * @param Request $request
     * @param int $page
     * @param int $itemsPerPage
     * @return JsonResponse
     */
    public function listAction(Request $request, $page = 0, $itemsPerPage = 0)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $fileArr = [];
            if ($page > 1) {
                $offset = (int)$page * (int)$itemsPerPage;
            } else {
                $offset = 0;
            }
            if (!isset($page) || $page <= 0) {
                throw new \Exception('Value of pages must be greater then 0');
            }
            if (!isset($itemsPerPage) || $itemsPerPage <= 0) {
                throw new \Exception('Value of items per page must be greater then 0');
            }


            $repository = $em->getRepository('PhotoApiBundle:File');
            $query = $repository->createQueryBuilder('f')
                ->orderBy('f.id', 'ASC')
                ->setFirstResult($offset)
                ->setMaxResults((int)$itemsPerPage)
                ->getQuery();
            $files = $query->getResult();
            $repository = $em->getRepository('PhotoApiBundle:FileTag');
            foreach ($files as $file) {
                $fileArr[] = $file->getName();
                $query = $repository->createQueryBuilder('ft')
                    ->where('ft.file = :file')
                    ->setParameter('file', $file->getId())
                    ->getQuery();
                $tags = $query->getResult();
                foreach ($tags as $tag) {
                    $fileArr[($file->getName())][] = $tag->getTag()->getName();
                }
            }
            return new JsonResponse($fileArr);
        } catch (\Exception $e) {
            return new JsonResponse(['Error' => json_encode($e->getMessage())]);
        }
    }

    /**
     * Create file entity with or without tags
     * @param Request $request
     * @return JsonResponse
     */
    public
    function addAction(Request $request)
    {
        try {
            $params = (array)$request->request->all();
            $uploadedFile = $request->files->get('photo');
            $em = $this->getDoctrine()->getManager();
            $dirPath = $this->getParameter('files_directory');
            $tmpPath = $dirPath . '/tmp';
            $file = new File();
            $date = new \DateTime("now");
            $size = 0;
            $adder = 'user';
            $added = $date;
            $modifier = 'user';
            $modified = $date;

            if (count($params) < 1) {
                throw new \Exception('No parameters');
            }
            if (!isset($uploadedFile)) {
                throw new \Exception('No file');
            }

            $mime = $uploadedFile->getMimeType();
            if (!in_array($mime, $this::MIMELIST)) {
                throw new \Exception('Bad file type');
            }


            $ext = $uploadedFile->guessExtension();
            $md5 = md5_file($uploadedFile);

            if (isset($params['file_name'])) {
                $fileName = $params['file_name'] . '.'. $ext;
            } else {
                $fileName = $uploadedFile->getClientOriginalName();
            }
            $tmpName = $tmpPath . '/' . $fileName;

            $file->setName($fileName);
            $file->setPath($tmpName);
            $file->setMime($mime);
            $file->setExt($ext);
            $file->setSize($size);
            $file->setMd5($md5);
            $file->setAdder($adder);
            $file->setAdded($added);
            $file->setModifier($modifier);
            $file->setModified($modified);
            $file->setGhost(false);

            $em->persist($file);
            $em->flush();

            $filePath = $dirPath. '/' . $file->getId() . '/';

            $uploadedFile->move($filePath, $file->getName());

            $em->persist($file);
            $em->flush();

            if (isset($params['tags']) && count($params['tags']) > 0) {
                $repository = $em->getRepository('PhotoApiBundle:Tag');
                foreach ($params['tags'] as $tagValue) {
                    $tag = $repository->findOneByName($tagValue);
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
                    $fileTag = new FileTag();
                    $fileTag->setFile($file);
                    $fileTag->setTag($tag);
                    $em->persist($fileTag);
                    $em->flush();

                }
            }
            return new JsonResponse(['Ok' => 'File was successfully added']);

        } catch (\Exception $e) {
            return new JsonResponse(['Error' => $e->getMessage()]);
        }
    }

    /**
     * Delete file action
     * @param Request $request
     * @param $fileId
     * @return JsonResponse
     */
    public
    function removeAction(Request $request, $fileId = 0)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            if ($fileId <= 0) {
                throw new \Exception('$fileId is not defined');
            }
            $repository = $em->getRepository('PhotoApiBundle:File');
            $file = $repository->find($fileId);
            if ($file) {
                unlink($file->getPath());
                $em->remove($file);
                $em->flush();
            } else {
                throw new \Exception('File not found');
            }
            return new JsonResponse(['query' => json_encode('File was successfully deleted')]);

        } catch (\Exception $e) {
            return new JsonResponse(['Error' => $e->getMessage()]);
        }
    }
}