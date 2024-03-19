<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\ConfigElementTypeBundle\ConfigElementType\Concrete;

use Contao\CoreBundle\Image\Studio\Studio;
use Contao\FilesModel;
use Contao\FrontendTemplate;
use Contao\StringUtil;
use HeimrichHannot\ConfigElementTypeBundle\ConfigElementType\ConfigElementData;
use HeimrichHannot\ConfigElementTypeBundle\ConfigElementType\ConfigElementResult;
use HeimrichHannot\ConfigElementTypeBundle\ConfigElementType\ConfigElementTypeInterface;

class ImageGalleryConfigElementType implements ConfigElementTypeInterface
{
    protected Studio $studio;

    public function __construct(Studio $studio) {
        $this->studio = $studio;
    }

    public static function getType(): string
    {
        return 'image_gallery';
    }

    public function getPalette(string $prependPalette, string $appendPalette): string
    {
        return $prependPalette.'{config_legend},imageSelectorField,imageField,imgSize;'.$appendPalette;
    }

    public function applyConfiguration(ConfigElementData $configElementData): ConfigElementResult
    {
        $configuration = $configElementData->getConfiguration();
        $itemData = $configElementData->getItemData();

        if ($configuration->imageSelectorField
            && $itemData[$configuration->imageSelectorField]
            && $configuration->imageField
            && $itemData[$configuration->imageField]
            or
            !$configuration->imageSelectorField
            && $configuration->imageField
            && $itemData[$configuration->imageField])
        {
            $multiSrc = StringUtil::deserialize($itemData[$configuration->imageField]);
            // Return if there are no files
            if (empty($multiSrc) || !\is_array($multiSrc)) {
                return new ConfigElementResult(ConfigElementResult::TYPE_NONE, null);
            }

            // Get the file entries from the database
            $images = FilesModel::findMultipleByUuids($multiSrc);

            if (!$images) {
                return new ConfigElementResult(ConfigElementResult::TYPE_NONE, null);
            }

            $imageSize = null;

            if ($configuration->imgSize) {
                $size = StringUtil::deserialize($configuration->imgSize);

                if ($size[0] > 0 || $size[1] > 0 || is_numeric($size[2])) {
                    $imageSize = $configuration->imgSize;
                }
            }

            $galleryData = [];

            foreach ($images as $filesModel)
            {
                $figureBuilder = $this->studio
                    ->createFigureBuilder()
                    ->fromUuid($filesModel->uuid);

                if ($imageSize) {
                    $figureBuilder->setSize($imageSize);
                }

                $figure = $figureBuilder->buildIfResourceExists();

                if ($figure === null) {
                    continue;
                }

                $template = new FrontendTemplate();
                $figure->applyLegacyTemplateData($template);
                $galleryData[] = $template->getData();
            }
        }

        return new ConfigElementResult(ConfigElementResult::TYPE_FORMATTED_VALUE, $galleryData);
    }
}
