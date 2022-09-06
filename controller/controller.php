<?php
    session_start(); // TO DO: login, user roles
    // echo __DIR__ . '<br>';
    // require_once(__DIR__ .'/../class/Log.php');
   
    // echo __DIR__ . '/../secure/settings.php';
    require_once('secure/settings.php');
    require_once('secure/config.php');
    require_once('model/Person.php');
    require_once('model/Category.php');
    // require_once('view/functions.php');

    // error_reporting(E_ALL); // default in dev
    $request = substr($_SERVER['REQUEST_URI'], 1);
    // C:\xampp\htdocs\_werk\birthday_calendar\controller\controller.php:4:string '_werk/birthday_calendar/persons/1' (length=33)
    // var_dump($request);
    // maak van de url een array met woorden uit de url met "/" 
    // als scheidingsteken, de url vanaf localhost wordt in stukjes 
    // geknipt op de plek van de "/". elk stukje is een 
    // element in de array
    $params = explode("/", $request);
    echo '<pre>';
    var_dump($params);
    echo '</pre>';
    // http://localhost/_werk/birthday_calendar/persons/1
    // 0 => string '_werk' (length=5)
    // 1 => string 'birthday_calendar' (length=17)
    // 2 => string 'persons' (length=7)
    // 3 => string 'view' (length=4)
    // 4 => string '1' (length=1)
    // 
    $class = $params[2] ?? null; // persons / categories
    $action = $params[3] ?? null; // view / add / edit / delete
    $id = $params[4] ?? null; //intval($params[4]) ?? null; // both convert to 0
    $error = '';
 
    switch ($class)
    {
        case 'persons':
            $person = new Person;// new person object
            switch ($action)
            {
                case 'view':
                    if ($id == 'all')
                    {
                        $persons = $person->ReadAll($pdo, $error); // get data for all persons
                        require_once(__DIR__ . '/../view/persons/viewPersons.php');
                    }
                    else if (intval($id > 0))
                    {
                        $id = (int) $id;
                        $person->Read($pdo, $id, $error); // get data for this person
                        require_once(__DIR__ . '/../view/persons/viewPerson.php');
                    }
                    else
                    {
                        require_once(__DIR__ . '/../view/default.php');
                    }
                break;
                case 'add':
                    require_once(__DIR__ . '/../view/persons/addPerson.php');
                break;
                case 'edit':
                    require_once(__DIR__ . '/../view/persons/editPerson.php');
                break;    
                case 'delete':
                    require_once(__DIR__ . '/../view/persons/deletePerson.php');            
                break;
                default:
                    require_once(__DIR__ . '/../view/default.php');
            }
        break;
        case 'categories':
            $category = new Category;
            switch ($action)
            {
                case 'view':
                    if ($id == 'all')
                    {
                        $categories = $category->ReadAll($pdo, $error);  // get data for all categories
                        require_once(__DIR__ . '/../view/categories/viewCategories.php');
                    }
                    else if (intval($id > 0))
                    {
                        $id = (int) $id;
                        $category->Read($pdo, $id, $error); // get data for this person
                        require_once(__DIR__ . '/../view/categories/viewCategory.php');
                    }
                    else
                    {
                        require_once(__DIR__ . '/../view/default.php');
                    }
                break;
                case 'add':
                    require_once(__DIR__ . '/../view/categories/addCategory.php');
                break;
                case 'edit':
                    require_once(__DIR__ . '/../view/categories/editCategory.php');
                break;    
                case 'delete':
                    require_once(__DIR__ . '/../view/categories/deleteCategory.php');            
                break;
                default:
                    require_once(__DIR__ . '/../view/default.php');
            }
        break;
        default:
            require_once(__DIR__ . '/../view/default.php');
    }
