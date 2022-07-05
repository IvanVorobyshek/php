<?php
    namespace MyProject\Controllers;

    use MyProject\Models\Articles\Article;
    use MyProject\View\View;
    

    Class ArticlesController{
        private $view;

        public function __construct(){
            $this->view = new View(__DIR__."/../../../templates");
        }

        public function view(int $articleId){
            $article = Article::getById($articleId);
            // $reflectors = new \ReflectionObject($article);
            // $properties = $reflectors -> getProperties();
            // $property = [];
            // foreach ($properties as $prop){
            //     $property[] = $prop -> getName();
            // }
            // echo '<pre>';
            // var_dump($property);
            // echo '</pre>';
            // return;


            if (null === $article){
                $this->view->renderHTML('errors/404.php',[], 404);
                return;
            }

            $this->view->renderHTML('articles/view.php', 
                [
                    'article' => $article,
                ]);
        }

        public function edit(int $articleId):void{
            $article = Article::getById($articleId);
            $reflector = new \ReflectionObject($article);      

            if(null === $article){
                $this->view->renderHTML('errors/404.php', [], 404);
                return;
            }

            $article->setName("Привет!!");
            $article->setText(", Андрей!");
            $article->save();
            
        }

        public function add(){
            $article = new Article();
            $article->setName("Article_1");
            $article->setText("Article_1Article_1Article_1Article_1");
            $article->setCreatedAt();
            $article->setAuthorId(1);

            // echo '<pre>';
            // var_dump($article);
            // echo '</pre>';
            $article->save();
        }

        public function viewAll(){
            echo 'We will show All articles later!';
        }
    }

?>