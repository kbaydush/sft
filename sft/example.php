<?php
/**
 * Created by PhpStorm.
 * User: kostia
 * Date: 11/27/17
 * Time: 12:05
 */


abstract class Publication
{
    protected $table;

    private $properties = [];

    static $something;

    /**
     * Publication constructor.
     * @int $id
     */
    public function __construct($id)
    {
        $result = mysqli_query('SELECT * FROM '. $this->table . ' WHERE id ="'. $id . '" LIMIT 1');

        $this->properties = mysqli_fetch_assoc($result);

    }

    /**
     * Show publications
     *
     */
    abstract public function doPrint();

    /**
     * @param $name
     *
     * @return bool|mixed
     */
    public function getProperties($name)
    {
        if(!isset($this->properties[$name]))
            return $this->properties[$name];


        return false;

    }

    /**
     * @param $name
     * @param $value
     *
     * @return $this|bool
     */
    public function setProperties($name, $value)
    {
        if(!isset($this->properties[$name]))
            return false;

        $this->properties[$name] = $value;

        return $this;
    }

}

class News extends Publication
{

    public function __construct($id)
    {
        $this->table = 'news_table';

        parent::__construct();
    }

    /**
     * output news
     */
    public function doPrint()
    {

        echo $this->getProperties('title');
        echo "<br /><br />";
        echo $this->getProperties('text');

        echo '<br />'. 'Источник:' . $this->getProperties('source');

    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }


}

class Announcement extends Publication
{

    public function __construct($id)
    {
        $this->table = 'announcement_table';

        parent::__construct();
    }

    /**
     * output news
     */
    public function doPrint()
    {

        echo $this->getProperties('title');
        echo "<br /><br />";

        echo "Обьявление действительно до " . $this->getProperties('end_date');

        echo '<br />'. $this->getProperties('text');

    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }


}


class Article extends Publication
{

    public function __construct($id)
    {
        $this->table = 'article_table';

        parent::__construct();
    }

    /**
     * output news
     */
    public function doPrint()
    {

        echo $this->getProperties('title');
        echo "<br /><br />";


        echo '<br />'. $this->getProperties('text');

        echo '<br /> &copy; '. $this->getProperties('author');

    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }


}