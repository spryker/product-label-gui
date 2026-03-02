<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\ProductLabelGui\Communication\Table;

use Spryker\Zed\ProductLabelGui\Communication\Table\ProductLabelTable;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class ProductLabelTableMock extends ProductLabelTable
{
    /**
     * @return $this
     */
    protected function init()
    {
        $this->request = new Request();
        $config = $this->newTableConfiguration();
        $config->setPageLength($this->getLimit());
        $config = $this->configure($config);
        $this->setConfiguration($config);

        return $this;
    }

    public function fetchData(): array
    {
        return $this->init()->prepareData($this->config);
    }

    public function setTwig(Environment $twig): void
    {
        $this->twig = $twig;
    }
}
