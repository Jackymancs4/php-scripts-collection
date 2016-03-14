<?php
include("class/exp-class.php");

$expression="x^y/(5*z)+10";

$exp=new Expression();

echo $expression;
echo "<br>";
echo $exp->to_postfix($expression);
echo "<br>";
echo $exp->to_prefix($expression);



?>