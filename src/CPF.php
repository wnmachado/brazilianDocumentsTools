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
        # Retira da string tudo que não estiver entre 0 e 9
        $c = preg_replace('/\D/', '', $this->value);

        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
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
}
