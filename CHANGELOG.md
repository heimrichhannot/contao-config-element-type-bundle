# Changelog
All notable changes to this project will be documented in this file.

## [0.2.0] - 2020-08-21
- added ConfigElementResult class
- added contao/core-bundle dependency
- renamed bundle to heimrichhannot/contao-config-element-type-bundle
- renamed  ConfigElementTypeData to ConfigElementData
- changed ConfigElementTypeInterface::applyConfiguration() signature to return ConfigElementResult instance
- changed ConfigElementData signature to use array as item data instead of mixed item instance
- replaced ImageUtil::addToTemplateData() with Controller::addImageToTemplate($template, $imageArray)
- removed heimrichhannot/contao-utils-bundle bundle dependency


## [0.1.0] - 2020-08-19
Initial release

- added ConfigElementTypeInterface
- added ConfigElementTypeData
- added ImageGalleryConfigElementType