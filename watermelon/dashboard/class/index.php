<?php
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

if (!isset($queries['id'])) {
    header('Location: /dashboard');
    exit;
}

$class_id = $queries['id'];
echo "class id: " . $class_id;
