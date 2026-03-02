<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductLabelGui\Communication\Form\Constraint;

use Spryker\Zed\ProductLabelGui\Dependency\Facade\ProductLabelGuiToProductLabelInterface;
use Symfony\Component\Validator\Constraint;

class AddIdsProductToDeAssignConstraint extends Constraint
{
    /**
     * @var string
     */
    public const OPTION_PRODUCT_LABEL_FACADE = 'productLabelFacade';

    /**
     * @var string
     */
    protected $message = 'This product has not been assigned to the given label';

    /**
     * @var \Spryker\Zed\ProductLabelGui\Dependency\Facade\ProductLabelGuiToProductLabelInterface
     */
    protected $productLabelFacade;

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getProductLabelFacade(): ProductLabelGuiToProductLabelInterface
    {
        return $this->productLabelFacade;
    }

    public function getTargets(): string
    {
        return static::CLASS_CONSTRAINT;
    }
}
