<?php

include 'class/exp-class.php';

$expression = 'x^y/(5*z)+(100+5)*2';

$exp = new Expression();

echo $expression;
echo '<br>';
echo $exp->to_postfix($expression);
echo '<br>';
echo $exp->to_prefix($expression);
echo '<br>';
echo $exp->to_infix($exp->to_postfix($expression));
