<?php
$pass = getenv('USER_PAS');
$user = getenv('USER_SQL');

echo "usuario: ".$user."\n";
echo "password: ".$pass."\n\n\n";

$pass = $_SERVER['USER_PAS'];
$user = $_SERVER['USER_SQL'];

echo "usuario: ".$user."\n";
echo "password: ".$pass."\n";

/*
$pass = $_ENV['USER'];
$user = $_ENV['USER_SQL'];

echo "usuario: ".$user."\n";
echo "password: ".$pass."\n";

print_r($_ENV); */