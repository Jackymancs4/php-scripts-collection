<?php

$mat[0][0] = 'a';
$mat[0][1] = 'b';
$mat[0][2] = 'c';
$mat[1][0] = 'd';
$mat[1][1] = 'e';
$mat[1][2] = 'f';
$mat[2][0] = 'g';
$mat[2][1] = 'h';
$mat[2][2] = 'i';

echo '<table>';
for ($i = 0;$i < count($mat);++$i) {
    echo '<tr>';
    for ($j = 0;$j < count($mat[$i]);++$j) {
        echo '<td>'.$mat[$i][$j].'</td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '<br><br>';
echo '<table>';
for ($i = 0;$i < count($mat);++$i) {
    echo '<tr>';
    for ($j = 0;$j < count($mat[$i]);++$j) {
        echo '<td>'.$mat[count($mat[$i]) - 1 - $j][$i].'</td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '<br><br>';
echo '<table>';
for ($i = 0;$i < count($mat);++$i) {
    echo '<tr>';
    for ($j = 0;$j < count($mat[$i]);++$j) {
        echo '<td>'.$mat[$j][count($mat[$i]) - 1 - $i].'</td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '<br><br>';
echo '<table>';
for ($i = 0;$i < count($mat);++$i) {
    echo '<tr>';
    for ($j = 0;$j < count($mat[$i]);++$j) {
        echo '<td>'.$mat[count($mat[$i]) - 1 - $i][$j].'</td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '<br><br>';
echo '<table>';
for ($i = 0;$i < count($mat);++$i) {
    echo '<tr>';
    for ($j = 0;$j < count($mat[$i]);++$j) {
        echo '<td>'.$mat[count($mat[$i]) - 1 - $i][count($mat[$i]) - 1 - $j].'</td>';
    }
    echo '</tr>';
}
echo '</table>';
