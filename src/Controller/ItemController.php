<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Item;
use App\Facade\ItemFacade;
use App\Form\ItemType;
use App\Modules\Http\BaseController;
use App\Repository\ItemRepository;
use App\Request\InsertItemRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends BaseController
{
    /**
     * @return Response
     * @Route(path="/api/items", name="add_item", methods={"POST"})
     */
    public function add(FormFactoryInterface $formFactoryBuilder, Request $request, ItemFacade $itemFacade): Response
    {
        $itemModel = new InsertItemRequest();
        $form = $formFactoryBuilder->create(ItemType::class, $itemModel);

        $item = $form->handleRequest($request);
        if(!$item->isValid()) {
            return $this->buildObjectResponse($this->getErrorsFromForm($form), Response::HTTP_BAD_REQUEST);
        }

        $itemFacade->createItem(
            $itemModel->getName(),
            $itemModel->getUnit(),
            $itemModel->getQuantity()
        );

        return new Response(null, Response::HTTP_CREATED);
    }

    /**
     * @param ItemRepository $itemRepository
     * @return Response
     * @Route(path="/api/items", name="add_item", methods={"GET"})
     */
    public function getCollection(ItemRepository $itemRepository): Response
    {
        return $this->buildQueryBuilderResponse($itemRepository->findAllQueryBuilder());
    }

    /**
     * @param ItemFacade $itemFacade
     * @param Item $item
     * @return Response
     * @Route(path="/api/items/{item_id}", name="add_item", methods={"DELETE"})
     * @ParamConverter(name="item", options={"id" = "item_id"})
     */
    public function remove(ItemFacade $itemFacade, Item $item): Response
    {
        $itemFacade->removeItem($item);

        return new Response(null, Response::HTTP_OK);
    }
}