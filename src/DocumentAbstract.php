<?php

namespace wnmachado\BrazilianDocumentsTools;

abstract class DocumentAbstract
{
    /**
     * Value to be validated
     *
     * @var string
     */
    protected $value;

    /**
     * Create a new DocumentValidate instance
     *
     * @param string $value
     */
    public function __construct($value = null)
    {
        if ($value) {
            $this->setValue($value);
        }
    }

    abstract public function isValid();
    abstract public function format();
    abstract public function getOnlyNumbers();
    abstract public function hideNumbers();

    /**
     * Get class name without namespace
     *
     * @return string
     */
    public function getClassName()
    {
        return substr(strrchr(get_class($this), '\\'), 1);
    }

    /**
     * Get the raw value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the clean value
     *
     * @return self
     */
    public function setValue($value)
    {
        $this->value = (string) preg_replace('/[\D]/', '', $value);
        return $this;
    }
}
