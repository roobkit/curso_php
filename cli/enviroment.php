<?php
$pass = getenv('PASS_SQL');
$user = getenv('USER_SQL');

echo "usuario: ".$user."\n";
echo "password: ".$pass."\n\n\n";

$pass = $_SERVER['PASS_SQL'];
$user = $_SERVER['USER_SQL'];

echo "usuario: ".$user."\n";
echo "password: ".$pass."\n";

/*
$pass = $_ENV['USER'];
$user = $_ENV['USER_SQL'];

echo "usuario: ".$user."\n";
echo "password: ".$pass."\n";

print_r($_ENV); */