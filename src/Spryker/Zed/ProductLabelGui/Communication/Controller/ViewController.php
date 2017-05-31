<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */


namespace Spryker\Zed\ProductLabelGui\Communication\Controller;


use Generated\Shared\Transfer\ProductLabelTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Spryker\Zed\ProductLabelGui\Communication\ProductLabelGuiCommunicationFactory;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method ProductLabelGuiCommunicationFactory getFactory()
 */
class ViewController extends AbstractController
{

    const PARAM_ID_PRODUCT_LABEL = 'id-product-label';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $idProductLabel = $this->castId($request->query->get(static::PARAM_ID_PRODUCT_LABEL));
        $productLabelTransfer = $this->getProductLabelById($idProductLabel);
        $this->hydrateLocaleTransferIntoLocalizedAttributes($productLabelTransfer);

        return $this->viewResponse([
            'productLabelTransfer' => $productLabelTransfer,
            'relatedProductTable' => $this->getRelatedProductTable($idProductLabel)->render(),
        ]);
    }

    /**
     * @param int $idProductLabel
     *
     * @return \Generated\Shared\Transfer\ProductLabelTransfer
     */
    protected function getProductLabelById($idProductLabel)
    {
        return $this
            ->getFactory()
            ->getProductLabelFacade()
            ->readLabel($idProductLabel);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductLabelTransfer $productLabelTransfer
     *
     * @return void
     */
    protected function hydrateLocaleTransferIntoLocalizedAttributes(ProductLabelTransfer $productLabelTransfer)
    {
        foreach ($productLabelTransfer->getLocalizedAttributesCollection() as $localizedAttributesTransfer)
        {
            $localeTransfer = $this
                ->getFactory()
                ->getLocaleFacade()
                ->getLocaleById($localizedAttributesTransfer->getFkLocale());
            $localizedAttributesTransfer->setLocale($localeTransfer);
        }
    }

    /**
     * @param int $idProductLabel
     *
     * @return \Spryker\Zed\ProductLabelGui\Communication\Table\RelatedProductOverviewTable
     */
    protected function getRelatedProductTable($idProductLabel)
    {
        return $this
            ->getFactory()
            ->createRelatedProductOverviewTable($idProductLabel);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction(Request $request)
    {
        $idProductLabel = $this->castId($request->query->get(static::PARAM_ID_PRODUCT_LABEL));
        $relatedProductTable = $this->getRelatedProductTable($idProductLabel);

        return $this->jsonResponse($relatedProductTable->fetchData());
    }

}
