# Contao Config Element Type Bundle

This bundle contains a generic interface, an generic data class and concrete independent implementations for config element types. 

Config element types are designed to specify things that can occur multiple times on the same item (e.g. many fields of the same type) and used in [List Bundle](https://github.com/heimrichhannot/contao-list-bundle) and [Reader Bundle](https://github.com/heimrichhannot/contao-reader-bundle).



## Setup

This bundle is a dependency bundle and has no usage as standalone package. If you want to create an extension that uses this bundle, add it to your composer.json file.

Install with composer:

    composer require heimrichhannot/contao-config-element-type-bundle
    
## Usage

The main content of this bundle is the ConfigElementTypeInterface. Example implementations can be found within the [bundled config element types](src/ConfigElementType/Concrete/).

The ConfigElementTypeInterface has three methods:
* `public static function getType(): string` - Returns an alias for identifying the content element type, typically used in database or translation context.
* `public function getPalette(string $prependPalette, string $appendPalette): string` - Return the contao dca palette. The paremeters can be used if you have default palette fields to prepend or append to the palette.
* `public function applyConfiguration(ConfigElementData $configElementData): ConfigElementResult` - Here the config element type logic is applied. Typically a raw field value is processed and a formatted field value returned. 

Real life usage examples can be found in [Reader Bundle](https://github.com/heimrichhannot/contao-reader-bundle) and [List Bundle](https://github.com/heimrichhannot/contao-list-bundle).