<?php
    namespace MyProject\Models;

    use MyProject\Services\Db;

    abstract class ActiveRecordEntity{
        //@var int
        protected $id;

        public function __set($name, $value){
            $camelCaseName = $this->underscoreToCamelCase($name);
            $this->$camelCaseName = $value;
        }

        private function underscoreToCamelCase(string $source):string{
            return lcfirst(str_replace('_','', ucwords($source, '_')));
        }

        public function getId():int{
            return $this->id;
        }

        public static function findAll(): array {
            $db = Db::getInstance();
            return $db->query('SELECT * FROM `'.static::getTableName().'`;', [], static::class);
        }

        abstract protected static function getTableName():string;

        public static function getById(int $id): ?self {
            $db = Db::getInstance();
            $entities = $db->query(
                'SELECT * FROM `'.static::getTableName().'` WHERE id=:id;',
                [':id' => $id],
                static::class
            );

            return $entities ? $entities[0] : null;
        }

        private function camelCaseToUnderscore(string $source):string{
            return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
        }

        private function mapPropertiesToDbFormat():array{
            $reflector = new \ReflectionObject($this);
            $properties = $reflector->getProperties();
            $mappedProperties = [];

            foreach($properties as $property){
                $propertyName = $property->getName();
                //echo $propertyName.'=';
                $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
                //echo $propertyNameAsUnderscore.'<br>';
                $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
            }

            return $mappedProperties;
        }

        public function save():void{
            $mappedProperties = $this->mapPropertiesToDbFormat();
            if ($this->id !== null){
                $this->update($mappedProperties);
            } else {
                $this->insert($mappedProperties);
            }
        }

        public function update(array $mappedProperties):void{
            $columns2params = [];
            $params2values = [];
            $index = 1;
            var_dump($mappedProperties);
            foreach ($mappedProperties as $key => $value){
                $param = ':param' . $index; // :param1
                $columns2params[] = $key . ' = ' . $param; // column1 = :param1
                $params2values[$param] = $value; // [:param1 => value1]
                $index++;
            }
            $sql = 'UPDATE '. static::getTableName() .' SET ' . implode(', ', $columns2params). ' WHERE id = '. $this->id;
            $db = Db::getInstance();
            $db->query($sql, $params2values, static::class);
            echo '<pre>';
            var_dump($sql);
            var_dump($columns2params);
            var_dump($params2values);
            echo '</pre>';
        }

        public function insert(array $mappedProperties):void{
            var_dump($mappedProperties);
            $columns = [];
            $params = [];
            $paramsAndValues = [];
            $index = 1;
            foreach($mappedProperties as $key => $value){
                //if (null !== $value){
                    $columns[] = $key;
                    $params[] = ':param'.$index;
                    $paramsAndValues[':param'.$index] = $value;
                    $index++;
                //}
            }
            echo '<br>';
            $sql = 'INSERT INTO '. static::getTableName() .' (' . implode(', ', $columns). ') VALUES ('. implode(', ', $params) .')';
            $db = Db::getInstance();
            $db->query($sql, $paramsAndValues, static::class);

            echo '<pre>';
            var_dump($sql);
            echo '</pre>';
            return;
            // INSERT INTO table_name (column1, column2, column3, ...)
	        // VALUES (value1, value2, value3, ...);
        }
    }

?>