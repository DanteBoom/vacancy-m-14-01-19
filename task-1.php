<?php
class First
{
    public function getClassname()
    {
        echo get_class($this);
        //or
//        echo static::class;
        //or
//        echo get_called_class();
    }
    public function getLetter()
    {
        echo "A";
    }
}

class Second extends First
{
    public function getLetter()
    {
        echo "B";
    }
}
