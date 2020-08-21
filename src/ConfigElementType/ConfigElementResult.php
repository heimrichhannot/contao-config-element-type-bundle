<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\ConfigElementTypeBundle\ConfigElementType;

class ConfigElementResult
{
    const TYPE_NONE = 0;
    const TYPE_FORMATTED_VALUE = 1;
    const TYPE_RAW_VALUE = 2;

    /**
     * @var string
     */
    protected $type;
    /**
     * @var mixed
     */
    protected $value;

    /**
     * ConfigElementResult constructor.
     *
     * @param mixed $value
     */
    public function __construct(string $type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }
}
