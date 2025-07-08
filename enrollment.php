<?php
// Simple enrollment management CLI script

$dataFile = __DIR__ . '/students.json';
$students = [];

if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $students = json_decode($json, true) ?: [];
}

$action = $argv[1] ?? null;

switch ($action) {
    case 'list':
        if (empty($students)) {
            echo "No students found\n";
        } else {
            foreach ($students as $id => $name) {
                echo "$id: $name\n";
            }
        }
        break;
    case 'add':
        $id = $argv[2] ?? null;
        $name = $argv[3] ?? null;
        if (!$id || !$name) {
            echo "Usage: php enrollment.php add <id> <name>\n";
            exit(1);
        }
        $students[$id] = $name;
        file_put_contents($dataFile, json_encode($students, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        echo "Added student $id: $name\n";
        break;
    case 'remove':
        $id = $argv[2] ?? null;
        if (!$id) {
            echo "Usage: php enrollment.php remove <id>\n";
            exit(1);
        }
        if (!isset($students[$id])) {
            echo "Student not found\n";
            exit(1);
        }
        unset($students[$id]);
        file_put_contents($dataFile, json_encode($students, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        echo "Removed student $id\n";
        break;
    default:
        echo "Usage: php enrollment.php [list|add|remove] ...\n";
        exit(0);
}
?>
