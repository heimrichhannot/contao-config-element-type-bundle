<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\ConfigElementTypeBundle\ConfigElementType;

interface ConfigElementTypeInterface
{
    /**
     * Return the config element type alias.
     */
    public static function getType(): string;

    /**
     * Return the config element type palette.
     *
     * By default $prependPalette and $appendPalette should be prepended/appended.
     *
     * Example: return $prependPalette.'{custom_legend},customField;'.$appendPalette;
     */
    public function getPalette(string $prependPalette, string $appendPalette): string;

    /**
     * Update the item data.
     */
    public function applyConfiguration(ConfigElementData $configElementData): ConfigElementResult;
}
