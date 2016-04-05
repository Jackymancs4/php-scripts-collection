<?php

class Matrix
{
    private $history;

    public function printM($matrix)
    {
        for ($i = 0;$i < count($matrix);++$i) {
            for ($j = 0;$j < count($matrix[$i]);++$j) {
                echo $matrix[$i][$j].' ';
            }
            echo '<br>';
        }
    }

    public function Scambia($matrix, $rigauno, $rigadue)
    {
        $temp = $matrix[$rigadue - 1];
        $matrix[$rigadue - 1] = $matrix[$rigauno - 1];
        $matrix[$rigauno - 1] = $temp;

        return $matrix;
    }

    public function Moltiplica($matrix, $riga, $fattore)
    {
        if ($fattore != 0) {
            for ($j = 0;$j < count($matrix[$riga - 1]);++$j) {
                $matrix[$riga - 1][$j] = $fattore * $matrix[$riga - 1][$j];
            }

            return $matrix;
        } else {
            return false;
        }
    }

    public function Combina($matrix, $rigauno, $rigadue, $fattore)
    {
        for ($j = 0;$j < count($matrix[$rigauno - 1]);++$j) {
            $matrix[$rigauno - 1][$j] = $matrix[$rigauno - 1][$j] + $fattore * $matrix[$rigadue - 1][$j];
        }

        return $matrix;
    }

    public function Gauss($matrix)
    {
        for ($i = 0;$i < count($matrix);++$i) {
            if ($matrix[$i][0] == 0) {
                $rigas = false;
                for ($j = 0;$j < count($matrix);++$j) {
                    if ($j > $i && $rigas == false && $matrix[$j][0] != 0) {
                        $rigas = $j;
                    }
                }
                if ($rigas != false) {
                    $matrix = $this->Scambia($matrix, $i + 1, $rigas + 1);
                }
            }
        }

        for ($i = 1;$i < count($matrix);++$i) {
            if ($matrix[$i][0] != 0) {
                $fattore = -$matrix[$i][0] / $matrix[0][0];
                $matrix = $this->Combina($matrix, $i + 1, 1, $fattore);
            }
        }

        $newmatrix = array();

        for ($i = 1;$i < count($matrix);++$i) {
            for ($j = 1;$j < count($matrix[$i]);++$j) {
                $newmatrix[$i - 1][$j - 1] = $matrix[$i][$j];
            }
        }
        if (count($newmatrix) > 1) {
            $newgmatrix = $this->Gauss($newmatrix);
        } else {
            $newgmatrix = $newmatrix;
        }

    //printM($newgmatrix);

    for ($i = 1;$i < count($matrix);++$i) {
        for ($j = 1;$j < count($matrix[$i]);++$j) {
            $matrix[$i][$j] = $newgmatrix[$i - 1][$j - 1];
        }
    }

        return $matrix;
    }

    public function GaussJordan($matrix)
    {
        for ($i = (count($matrix) - 1);$i >= 0;--$i) {
            if ($i == (count($matrix) - 1) && $matrix[$i][count($matrix[$i]) - 1] != 0) {
                $fattore = 1 / $matrix[$i][count($matrix[$i]) - 1];
                $matrix = $this->Moltiplica($matrix, count($matrix[$i]), $fattore);
            } elseif ($matrix[$i][count($matrix[$i]) - 1] != 0) {
                $fattore = -$matrix[$i][count($matrix[$i]) - 1] / $matrix[count($matrix) - 1][count($matrix[count($matrix) - 1]) - 1];
                $matrix = $this->Combina($matrix, $i + 1, count($matrix), $fattore);
            }
        }

        $newmatrix = array();

        for ($i = 0;$i < count($matrix) - 1;++$i) {
            for ($j = 0;$j < count($matrix[$i]) - 1;++$j) {
                $newmatrix[$i][$j] = $matrix[$i][$j];
            }
        }
        if (count($newmatrix) > 1) {
            $newgmatrix = $this->GaussJordan($newmatrix);
        } else {
            $fattore = 1 / $matrix[0][0];
            $newmatrix = $this->Moltiplica($newmatrix, 1, $fattore);
            $newgmatrix = $newmatrix;
        }

    //printM($newgmatrix);

    for ($i = 0;$i < count($matrix) - 1;++$i) {
        for ($j = 0;$j < count($matrix[$i]) - 1;++$j) {
            $matrix[$i][$j] = $newgmatrix[$i][$j];
        }
    }

        return $matrix;
    }

    public function product($A, $B)
    {
        $An = count($A);
        $Am = count($A[0]);
        $Bn = count($B);
        $Bm = count($B[0]);

        $C = array();

        $sum = 0;

        for ($i = 0; $i < $An; ++$i) {
            for ($j = 0; $j < $Bm; ++$j) {
                $sum = 0;

                for ($k = 0; $k < $Am; ++$k) {
                    if (gettype($sum) == 'integer' && gettype($A[$i][$k]) == 'integer' && gettype($B[$k][$j]) == 'integer') {
                        $sum = $sum + $A[$i][$k] * $B[$k][$j];
                    } else {
                        $sum = $sum.'+'.$A[$i][$k].'*'.$B[$k][$j];
                    }
                }

                $C[$i][$j] = $sum;
            }
        }

        return $C;
    }
}
