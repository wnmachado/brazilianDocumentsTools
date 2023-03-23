<?php

namespace wnmachado\BrazilianDocumentsTools;

class CPF extends DocumentAbstract
{
    /**
     * Check if it is a valid CPF number
     *
     * @return bool|string
     */
    public function isValid(): bool
    {
        $isValid = true;
        # Retira da string tudo que não estiver entre 0 e 9
        $c = preg_replace('/\D/', '', $this->value);

        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            $isValid = false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            $isValid = false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            $isValid = false;
        }

        return $isValid;
    }

    /**
     * Format CPF
     *
     * @return string
     */
    public function format()
    {
        if (!$this->isValid()) {
            return false;
        }

        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $this->value);
    }

    /**
     * Get only numbers of CPF
     *
     * @return string
     */
    public function getOnlyNumbers()
    {
        return preg_replace("/\D/", "", $this->value);
    }

    /**
     * Hide numbers of CPF
     *
     * @return string
     */
    public function hideNumbers()
    {
        $document = $this->getOnlyNumbers();
        return substr($document, 0, 3) . '.###.###-' . substr($document, 9, 2);
    }
}
