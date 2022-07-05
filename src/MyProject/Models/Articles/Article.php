<?php
    namespace MyProject\Models\Articles;

    use MyProject\Models\ActiveRecordEntity;
    use MyProject\Models\Users\User;

    Class Article extends ActiveRecordEntity{

        //@var string
        protected $authorId;

        //@var string
        protected $name;

        //@var string
        protected $text;

        //@var string
        protected $createdAt;

        public function getName():string{
            return $this->name;
        }

        public function getText():string{
            return $this->text;
        }

        protected static function getTableName():string{
            return 'articles';
        }

        public function getAuthorId(): int
        {
            return (int) $this->authorId;
        }

        public function getAuthor(): User{
            return User::getById($this->authorId);
        }

        public function setName(string $name){
            $this->name = $name;
        }

        public function setText(string $text){
            $this->text = $text;
        }

        public function setCreatedAt(){
            $this->createdAt = date('Y-m-d H:i:s');
        }

        public function setAuthorId(int $authorId){
            $this->authorId = $authorId;
        }


    }
?>