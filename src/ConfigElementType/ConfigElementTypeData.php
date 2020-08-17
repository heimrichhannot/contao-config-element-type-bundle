<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ConfigElementTypeBundle\ConfigElementType;


use HeimrichHannot\ListBundle\Model\ListConfigElementModel;
use HeimrichHannot\ReaderBundle\Model\ReaderConfigElementModel;

class ConfigElementTypeData
{
    protected $item;

    protected $configuration;

    /**
     * ConfigElementTypeData constructor.
     * @param $item
     * @param $configuration
     */
    public function __construct($item, $configuration)
    {
        $this->item          = $item;
        $this->configuration = $configuration;
    }


    /**
     * @return \HeimrichHannot\ListBundle\Item\ItemInterface|\HeimrichHannot\ReaderBundle\Item\ItemInterface
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param \HeimrichHannot\ListBundle\Item\ItemInterface|\HeimrichHannot\ReaderBundle\Item\ItemInterface $item
     */
    public function setItem($item): void
    {
        $this->item = $item;
    }

    /**
     * @return ReaderConfigElementModel|ListConfigElementModel
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param ReaderConfigElementModel|ListConfigElementModel $configuration
     */
    public function setConfiguration($configuration): void
    {
        $this->configuration = $configuration;
    }


}