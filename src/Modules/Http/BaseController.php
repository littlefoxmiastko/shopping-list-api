<?php
declare(strict_types=1);

namespace App\Modules\Http;

use App\Modules\Http\Model\ResponseHeader;
use App\Modules\Http\Request\RequestHandlerInterface;
use App\Modules\Http\Response\HeaderFactory;
use App\Modules\Http\Serializer\Serializer;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

class BaseController
{
    /** @var Paginator  */
    private $paginator;

    /** @var RequestHandlerInterface  */
    private $requestHandler;

    /** @var Serializer */
    private $serializer;

    /** @var HeaderFactory */
    private $headerFactory;

    public function __construct(Paginator $paginator,
                                RequestHandlerInterface $requestHandler,
                                Serializer $serializer,
                                HeaderFactory $headerFactory)
    {
        $this->paginator = $paginator;
        $this->requestHandler = $requestHandler;
        $this->serializer = $serializer;
        $this->headerFactory = $headerFactory;
    }

    protected function buildQueryBuilderResponse(QueryBuilder $queryBuilder): Response
    {
        $paginator = $this->paginator->paginate(
            $queryBuilder,
            $this->requestHandler->getCurrentPage(),
            $this->requestHandler->getPageSize()
        );

        $responseHeader = new ResponseHeader();
        $responseHeader->setCurrentPage($this->requestHandler->getCurrentPage());
        $responseHeader->setCurrentPageItems($this->paginator->getCurrentItems());
        $responseHeader->setPagesCount($this->paginator->getPagesCount());
        $responseHeader->setTotalItems($this->paginator->getTotalItems());

        return new Response(
            $this->serializer->get()->serialize($paginator, Serializer::DEFAULT_FORMAT),
            Response::HTTP_OK,
            $this->headerFactory->produceForCollection($responseHeader)
        );
    }

    protected function buildObjectResponse($input, int $code = Response::HTTP_OK): Response
    {
        return new Response(
            $this->serializer->get()->serialize($input, Serializer::DEFAULT_FORMAT),
            $code,
            $this->headerFactory->produceForSingleObject()
        );
    }

    protected function getErrorsFromForm(FormInterface $form): array
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
    }
}