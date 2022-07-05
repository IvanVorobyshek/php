<?php
// $arr = array(
    //     ['key1' => 'val1', 'key2' => 'val2'],
    //     ['key3' => 'val3', 'key4' => 'val4']

    // );
    // ['article' => $arr];

    
    // $colors = array('blue', 'green', 'pink', 'black', 'grey');

    // foreach ($colors as &$color){
    //     $color = strtoupper($color);
    // }
    // echo $color;
    // unset($color);
    // print_r($colors);

    // заполняем массив всеми элементами из директории
    // $handle = opendir('.');
    // while (false !== ($file = readdir($handle))) {
    //     $files[] = $file;
    // }
    // closedir($handle);

    // var_dump($files);

    // echo count($files);
        // $arr1 = array(1, 2);
        // $arr2 = $arr1;
        // $arr2[] = 4;

        // $arr3 = &$arr1;
        // $arr3[] = 4;
        // unset($arr3);
        // var_dump($arr1);
        // var_dump($arr2);
        // var_dump($arr3);
        
        
        

    

    // $pattern = '~^hello/(.*)$~';
    // preg_match($pattern, $route, $matches);
    // if(!empty($matches)){
    //     $controller = new MainController();
    //     $controller->sayHello($matches[1]);
    //     return;
    // }

    // $pattern = '~^$~';
    // preg_match($pattern, $route, $matches);
    // if(!empty($matches)){
    //     $controller = new MainController();
    //     $controller-> main();
    //     return;
    // }


    Class q {

        public function query(string $sql, $params = []): ?array {
            $sth = $this->pdo->prepare($sql);
            $result = $sth->execute($params);
            return $sth->fetchAll();
        }
    }
?>