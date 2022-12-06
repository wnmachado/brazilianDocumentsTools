<?php

namespace wnmachado\BrazilianDocumentsTools;

class Document extends DocumentAbstract
{
    /**
     * Value to be validated
     *
     * @var string
     */
    public $obj;

    /**
     * Get document type
     */
    public function getType(): String
    {
        return $this->obj->getClassName();
    }

    /**
     * Check if it is a valid number
     *
     * @return bool|string
     */
    public function isValid()
    {
        return $this->obj->isValid();
    }

    /**
     * Format number
     *
     * @return string
     */
    public function format()
    {
        return $this->obj->format();
    }

    /**
     * Get the raw value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->obj->getValue();
    }

    /**
     * Set the clean value
     *
     * @return self
     */
    public function setValue($value)
    {
        $value = (string) preg_replace('/[\D]/', '', $value);

        if (strlen($value) === 11) {
            $this->obj = new CPF($value);
        } else {
            $this->obj = new CNPJ($value);
        }

        return $this;
    }
}
