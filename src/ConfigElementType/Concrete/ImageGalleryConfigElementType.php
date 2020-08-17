<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ConfigElementTypeBundle\ConfigElementType\Concrete;

use Contao\FilesModel;
use Contao\StringUtil;
use HeimrichHannot\ConfigElementTypeBundle\ConfigElementType\ConfigElementTypeData;
use HeimrichHannot\ConfigElementTypeBundle\ConfigElementType\ConfigElementTypeInterface;
use HeimrichHannot\ListBundle\ConfigElementType\ListConfigElementData;
use HeimrichHannot\ReaderBundle\ConfigElementType\ReaderConfigElementData;
use HeimrichHannot\UtilsBundle\Image\ImageUtil;
use InvalidArgumentException;

class ImageGalleryConfigElementType implements ConfigElementTypeInterface
{
    /**
     * @var ImageUtil
     */
    protected $imageUtil;


    /**
     * ImageGalleryConfigElementType constructor.
     */
    public function __construct(ImageUtil $imageUtil)
    {
        $this->imageUtil = $imageUtil;
    }

    public static function getType(): string
    {
        return 'image_gallery';
    }

    public function getPalette(string $prependPalette, string $appendPalette): string
    {
        return $prependPalette.'{config_legend},imageSelectorField,imageField,imgSize;'.$appendPalette;
    }

    public function applyConfiguration(ConfigElementTypeData $configElementData): void
    {
        $configuration = $configElementData->getConfiguration();
        $item = $configElementData->getItem();

        if (($configuration->imageSelectorField && $item->getRawValue($configuration->imageSelectorField) && $configuration->imageField && $item->getRawValue($configuration->imageField)) || (!$configuration->imageSelectorField && $configuration->imageField && $item->getRawValue($configuration->imageField))) {

            $multiSrc = StringUtil::deserialize($item->getRawValue($configuration->imageField));
            // Return if there are no files
            if (empty($multiSrc) || !\is_array($multiSrc))
            {
                return;
            }

            // Get the file entries from the database
            $images = FilesModel::findMultipleByUuids($multiSrc);

            $galleryData = [];

            foreach ($images as $index => $filesModel) {
                $imageArray['singleSRC'] = $filesModel->path;
                if ($configuration->imgSize) {
                    $size = StringUtil::deserialize($configuration->imgSize);

                    if ($size[0] > 0 || $size[1] > 0 || is_numeric($size[2])) {
                        $imageArray['size'] = $configuration->imgSize;
                    }
                }
                $galleryData[$index] = [];
                $this->imageUtil->addToTemplateData('singleSRC', '', $galleryData[$index], $imageArray, null, null, null, $filesModel);
            }
        }
        $item->setFormattedValue($configuration->templateVariable, $galleryData);
    }
}