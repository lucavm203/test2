<?php
    Class Person 
    {
        private $memberdata = array();

        private function checkParams($params=[], &$errorMessage='')
        {
            $has_errors = false;
            foreach ($params as $key => $value)
            {
                if (empty($value))
                {
                    $errorMessage .= "Member '$key' can not be empty. ";
                    $has_errors = true;
                }
            }
            if ($has_errors)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        public function __construct($params=[]) 
        {

            $errorMessage = '';
            if ($this->checkParams($params, $errorMessage))
            {
                $this->memberdata = $params;
            }
            else
            {
                throw new Exception($errorMessage);
            }
        }

        public function __get($name)
        {
            return $this->$name;
        }

        public function __set($member, $value)
        {
            if (!empty($member) && !empty($value))
            {
                $this->memberdata[$member] = $value;
            }
        }

        public function Create($pdo, &$error) // saves an existing object to db
        {
            $sql = "INSERT INTO persons (idperson, categories_idcategory, first_name, preposition, last_name, day_of_birth) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $success = $stmt->execute( [ $this->memberdata['idperson'], $this->memberdata['categories_idcategory'], $this->memberdata['first_name'], 
                            $this->memberdata['preposition'], $this->memberdata['last_name'], $this->memberdata['day_of_birth'] ] );
            if (!$success)
            {
                throw new Exception( $stmt->errorCode() . '. ' . $stmt->errorInfo()[2]);
                $error .= $stmt->errorCode() . '. ' . $stmt->errorInfo()[2];
            }
        }

        public function Read($pdo, $id = null, &$error = '')
        {
            if (is_int($id))
            {
                // echo $id;
                if ($id == 0) // early return;
                {
                    $error = 'Id 0 is not valid';
                    return;
                }

                // $id = intval($id);
                // select where id = $id
                // check if found
                // https://www.php.net/manual/en/pdostatement.rowcount.php
                $sql = "SELECT * FROM persons WHERE idperson = :idperson"; // , categories WHERE persons.categories_idcategory = categories.idcategory';
                $statement = $pdo->prepare($sql);
                $statement->bindParam(':idperson', $id, PDO::PARAM_INT);

                if ($statement->execute())
                {   
                    // echo 'execute';
                    $result =  $statement->fetch(PDO::FETCH_ASSOC);
                    // echo '============' . $statement->rowCount();
                    // var_dump($result);
                    if ($statement->rowCount() == 0)
                    {
                        $error .= "Person with idperson $id not found.";
                    }
                    else if ($statement->rowCount() == 1)
                    {
                        // echo gettype($result);
                        // return $result;
                        foreach ($result as $key => $value)
                        {
                            // echo "$key : $value <br>";
                            $this->$key = $value;
                        }
                    }
                    else 
                    {
                        $error .= "Id $id not unique.";
                    }
                }
                else
                {
                    $error .= 'Statement did not execute.';
                }
            }
            else
            {
                $error .= "Id must be an int value, '$id' given.";
            }
        }

        public function ReadAll($pdo, &$error = '')
        {
            // echo 'id null';
            $sql = 'SELECT * FROM persons' ; //, categories WHERE persons.categories_idcategory = categories.idcategory';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $persons = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Person");
            return $persons;
        }

        public function Update($pdo, $params = null,  &$error = '')
        {
            if ($params == null)
            {
                $error .= 'Params empty';
                return;
            }
            else
            {
                // try update statement
                // persons (idperson, categories_idcategory, first_name, preposition, last_name, day_of_birth) 
                $sql = "UPDATE persons 
                        SET idperson = ?, categories_idcategory = ?, first_name = ?, preposition = ?, last_name = ?, day_of_birth = ?
                        WHERE idperson = ?";
                $stmt = $pdo->prepare($sql);
                $success = $stmt->execute( [ $params['idperson_new'], $params['categories_idcategory'], $params['first_name'], 
                                    $params['preposition'], $params['last_name'], $params['day_of_birth'], $params['idperson_old'] ] );
                if (!$success)
                {
                    // throw new Exception( $stmt->errorCode() . '. ' . $stmt->errorInfo()[2]);
                    $error .= $stmt->errorCode() . '. ' . $stmt->errorInfo()[2];
                }
            }
        }

        public function Delete($pdo, int $id = null, &$error = '')
        {
            if ($id == null)
            {
                $error .= 'No id given';
            }
            if (is_int($id))
            {
                // delete where id = $id
                // check if id was found
                $sql = "DELETE FROM persons WHERE idperson = :idperson";
                $statement = $pdo->prepare($sql);
                $statement->bindParam(':idperson', $id, PDO::PARAM_INT);
                if ($statement->execute())
                {   
                    if ($statement->rowCount() == 0)
                    {
                        $error .= "Person with idperson $id not found.";
                    }
                    // else if ($statement->rowCount() == 1)
                    // {
                    //     echo "Deleted person with id $id";
                    // }
                }
                else
                {
                    $error .= 'Statement did not execute.';
                }
                
            }
        }

        public function setName($firstName, $preposition, $lastName)
        {
            if (empty($firstName) || empty ($lastName))
            {
                throw new Exception('Name cannot be empty');
                return;
            }
            $this->firstName = $firstName;
            $this->preposition = $preposition;
            $this->lastName = $lastName;
        }

        public function __toString()
        {
            $result = '';
            $sep = ',';
            foreach ($this->memberdata as $key => $value)
            {
                $result .= "$key : $value $sep ";
            }
            return substr($result, 0, -2);
        }
    }