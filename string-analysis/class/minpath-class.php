<?php

class Astar
{
    private $matrix;
    private $path;

    public function Astar($mat, $start = false, $goal = false)
    {
        $this->matrix = $mat;

        if ($start != false) {
            $this->Astar_path($start, $goal);
        }
    }

    public function heuristic_cost_estimate($start, $goal, $zero = true)
    {
        if ($zero == true) {
            return 0;
        } else {
            return 1;
        }
    }

    public function min_val($vet)
    {
        $old = false;
        $minindex = '0-0-0';
        foreach ($vet as $key => $value) {
            if ($old == false) {
                $old = $value;
                $minindex = $key;
            }

            if ($old > $value) {
                $old = $value;
                $minindex = $key;
            }
        }

        return $minindex;
    }

    public function get_ind($val, $vet)
    {
        $index = 0;
        for ($i = 0; $i < count($vet); ++$i) {
            if ($val == $vet[$i]) {
                $index = $i;
            }
        }

        return $index;
    }

    public function get_neighbor($cell)
    {
        $cell = explode('-', $cell);
        $mat = $this->matrix;

        $neighbor = array();

        if (isset($mat[($cell[0] + 1)][$cell[1]]) && $mat[($cell[0] + 1)][$cell[1]] == ($cell[2] + 1)) {
            $neighbor[] = ($cell[0] + 1).'-'.($cell[1]).'-'.($mat[($cell[0] + 1)][$cell[1]]);
        }
        if (isset($mat[($cell[0])][$cell[1] + 1]) && $mat[$cell[0]][($cell[1] + 1)] == ($cell[2] + 1)) {
            $neighbor[] = ($cell[0]).'-'.($cell[1] + 1).'-'.($mat[$cell[0]][($cell[1] + 1)]);
        }
        if (isset($mat[($cell[0] + 1)][$cell[1] + 1]) && ($mat[($cell[0] + 1)][($cell[1] + 1)] == ($cell[2] + 1) || $mat[($cell[0] + 1)][($cell[1] + 1)] == ($cell[2]))) {
            $neighbor[] = ($cell[0] + 1).'-'.($cell[1] + 1).'-'.($mat[($cell[0] + 1)][($cell[1] + 1)]);
        }

        return $neighbor;
    }

    public function validate_node($node)
    {
        $node = explode('-', $node);
        $node = $node[0].'-'.$node[1].'-'.$this->matrix[$node[0]][$node[1]];

        return $node;
    }

    public function reconstruct_path($current, $came_from = false)
    {
        $total_path = array($current);

        if ($came_from == false) {
            $came_from = $this->path;
        }

        while (isset($came_from[$current])) {
            $current = $came_from[$current];
            $total_path[] = $current;
        }

        return $total_path;
    }

    public function path_mat($goal, $void = '.')
    {
        $ret = array();
        $minpath = $this->reconstruct_path($goal);

        for ($i = 0; $i < count($this->matrix); ++$i) {
            for ($j = 0; $j < count($this->matrix[$i]); ++$j) {
                $ret[$i][$j] = $void;
            }
        }

        for ($h = 0; $h < count($minpath); ++$h) {
            $cell = explode('-', $minpath[$h]);
            $ret[$cell[0]][$cell[1]] = $cell[2];
        }

        return $ret;
    }

    public function Astar_path($start, $goal = false)
    {
        $start = $this->validate_node($start);

        $closedset = array();
        $openset[0] = $start;
        $came_from = array();

        $g_score[$start] = 0;
        $f_score[$start] = $g_score[$start] + $this->heuristic_cost_estimate($start, $goal);

        $t_score = $f_score;

        while (count($openset) != 0) {
            $min = $this->min_val($t_score);
            $current = $min;

            if ($current == $goal && $goal != false) {
                $this->path = $came_from;
                $goal = $this->validate_node($goal);

                return $this->reconstruct_path($goal, $came_from);
            }

            $stopfor = false;

            foreach ($openset as $key => $value) {
                if ($value == $current) {
                    unset($openset[$key]);
                    unset($t_score[$current]);
                }
            }

            $closedset[] = $current;
            $neighbor = $this->get_neighbor($current);

            for ($i = 0; $i < count($neighbor); ++$i) {
                if (!in_array($neighbor[$i], $closedset)) {
                    $tentative_g_score = $g_score[$current] + explode('-', $neighbor[$i])[2];

                    if (!in_array($neighbor[$i], $openset)) {
                        $openset[] = $neighbor[$i];
                        $came_from[$neighbor[$i]] = $current;
                        $g_score[$neighbor[$i]] = $tentative_g_score;
                        $f_score[$neighbor[$i]] = $g_score[$neighbor[$i]] + $this->heuristic_cost_estimate($neighbor[$i], $goal);
                        $t_score[$neighbor[$i]] = $g_score[$neighbor[$i]] + $this->heuristic_cost_estimate($neighbor[$i], $goal);
                    } elseif ($tentative_g_score < $g_score[$neighbor[$i]]) {
                        $came_from[$neighbor[$i]] = $current;
                        $g_score[$neighbor[$i]] = $tentative_g_score;
                        $f_score[$neighbor[$i]] = $g_score[$neighbor[$i]] + $this->heuristic_cost_estimate($neighbor[$i], $goal);
                        $t_score[$neighbor[$i]] = $g_score[$neighbor[$i]] + $this->heuristic_cost_estimate($neighbor[$i], $goal);
                    }
                }
            }
        }
        $this->path = $came_from;

        return $came_from;
    }
}
