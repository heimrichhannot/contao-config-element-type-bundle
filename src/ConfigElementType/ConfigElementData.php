<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\ConfigElementTypeBundle\ConfigElementType;

use Contao\Model;

class ConfigElementData
{
    /** @var array */
    protected $itemData;

    protected $configuration;

    /**
     * ConfigElementTypeData constructor.
     *
     * @param $item
     * @param $configuration
     */
    public function __construct(array $item, $configuration)
    {
        $this->itemData = $item;
        $this->configuration = $configuration;
    }

    public function getItemData(): array
    {
        return $this->itemData;
    }

    public function setItemData(array $itemData): void
    {
        $this->itemData = $itemData;
    }

    public function getConfiguration(): Model
    {
        return $this->configuration;
    }

    public function setConfiguration(Model $configuration): void
    {
        $this->configuration = $configuration;
    }
}
