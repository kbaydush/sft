<?php
/**
 * Created by PhpStorm.
 * User: kostia
 * Date: 11/26/17
 * Time: 12:44
 */

abstract class Publication
{

    protected $table;

    protected $properties;

    protected $link;

    public function __construct($id)
    {

        $result = mysqli_query($this->link, 'SELECT * FROM `' . $this->table . '` WHERE `id`="' . $id . '" LIMIT 1');

        $this->properties = mysqli_fetch_assoc($result);

    }

    public function getProperty($name)
    {

        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        }

        return false;

    }

    public function setProperty($name, $value)
    {

        if (!isset($this->properties[$name]))
            return false;

        $this->properties[$name] = $value;

        return $value;

    }

    abstract public function doPrint();


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }


}

class News extends Publication
{


    public function __construct($id)
    {

        $this->table = 'news_table';

        parent::__construct();

    }

    public function doPrint()
    {
        echo $this->properties['title'];

        echo "<br /><br />";

        echo $this->properties['text'];

        echo '<br /><br />  Источник' . $this->properties['source'];

    }
}

class Announcement extends Publication
{
    // конструктор класса объявлений, производного от класса публикаций
    public function __construct($id)
    {
        // устанавливаем значение таблицы, в которой хранятся данные по объявлениям
        $this->table = 'announcements_table';
        // вызываем конструктор родительского класса
        parent::__construct($id);
    }

    // переопределяем абстрактный метод печати
    public function doPrint()
    {
        echo $this->properties['title'];
        echo '<br />Внимание! Объявление действительно до ' . $this->properties['end_date'];
        echo '<br /><br />' . $this->properties['text'];
    }
}

class Article extends Publication
{
    // конструктор класса статей, производного от класса публикаций
    public function __construct($id)
    {
        // устанавливаем значение таблицы, в которой хранятся данные по статьям
        $this->table = 'articles_table';
        // вызываем конструктор родительского класса
        parent::__construct($id);
    }

    // переопределяем абстрактный метод печати
    public function doPrint()
    {
        echo $this->properties['title'];
        echo '<br /><br />';
        echo $this->properties['text'];
        echo '<br />&copy; ' . $this->properties['author'];
    }
}

$publications[] = new News($news_id);
$publications[] = new Announcement($announcement_id);
$publications[] = new Article($article_id);

foreach ($publications as $publication) {

    if ($publications instanceof Publication) {

        $publication->doPrint();

    } else {

        throw new Exception("There is not a publication");
    }

}


https://habrahabr.ru/post/37576/


?>