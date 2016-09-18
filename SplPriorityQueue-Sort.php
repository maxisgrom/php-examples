<?php

/**
 * @param string $className
 *
 * @return int
 */

function priority($className) {

    if (stripos($className, 'iterator') !== false)
        return 2;
    if (stripos($className, 'spl') !== false)
        return 3;
    if (stripos($className, 'exception') !== false)
        return 0;

    return 1;
}

$spl_classes = spl_classes();

//Отсортированный вывод доступных классов в SPL
echo 'Sorted:' . PHP_EOL;
$output = new SplPriorityQueue();

foreach ($spl_classes as $class) {
    $output->insert($class, priority($class));
}

while (!$output->isEmpty()) {
    echo $output->extract() . PHP_EOL;
}

//Обычный вывод доступных классов в SPL
echo 'Unsorted:' . PHP_EOL;
echo implode(PHP_EOL, $spl_classes);