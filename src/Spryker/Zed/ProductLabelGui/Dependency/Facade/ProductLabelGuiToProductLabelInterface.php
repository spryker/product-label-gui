<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductLabelGui\Dependency\Facade;

use Generated\Shared\Transfer\ProductLabelResponseTransfer;
use Generated\Shared\Transfer\ProductLabelTransfer;

interface ProductLabelGuiToProductLabelInterface
{
    /**
     * @param int $idProductLabel
     *
     * @return \Generated\Shared\Transfer\ProductLabelTransfer|null
     */
    public function findLabelById($idProductLabel): ?ProductLabelTransfer;

    /**
     * @return array<\Generated\Shared\Transfer\ProductLabelTransfer>
     */
    public function findAllLabels(): array;

    public function createLabel(ProductLabelTransfer $productLabelTransfer): void;

    public function updateLabel(ProductLabelTransfer $productLabelTransfer): void;

    /**
     * @param int $idProductLabel
     * @param array<int> $idsProductAbstract
     *
     * @return void
     */
    public function addAbstractProductRelationsForLabel($idProductLabel, array $idsProductAbstract): void;

    /**
     * @param int $idProductLabel
     * @param array<int> $idsProductAbstract
     *
     * @return void
     */
    public function removeAbstractProductRelationsForLabel($idProductLabel, array $idsProductAbstract): void;

    public function removeLabel(ProductLabelTransfer $productLabelTransfer): ProductLabelResponseTransfer;

    /**
     * @param int $idProductLabel
     *
     * @return array<int>
     */
    public function findProductAbstractRelationsByIdProductLabel($idProductLabel): array;
}
