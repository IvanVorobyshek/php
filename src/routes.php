<?php

return [
    '~^articles/(\d+)$~'=> [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit(/*)$~'=> [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/add(/*)$~'=> [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^articles(/*)$~'=> [\MyProject\Controllers\ArticlesController::class, 'viewAll'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'],
    '~^bye/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayBye'],
];
?>