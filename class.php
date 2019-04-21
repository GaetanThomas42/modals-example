<?php 
    $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
    
    class Book{

        private $price;
        private $title;

        public function __construct($title, $price){
            $this->title = $title;
            $this->price = $price;
        }

        public function __destruct () {
            echo "<br>" . $this->title . "Destructed <br>";
        }

        public function setPrice($par) {
            $this->price=$par;            
        }
        public function setTitle($par) {
            $this->title=$par;            
        }

        public function getPrice() {
            echo $this->price ."<br>";
        }
        public function getTitle() {
            echo $this->title ."<br>";
        }
    }

    $datas = ["php",5, "Python", 10,"Css", 12,"Javascript", 9, "Algorithm", 6];
    $books = [];
    for ($i=0; $i < 10; $i+=2) { 
        array_push($books,new Book($datas[$i],$datas[$i+1]));
    }

    var_dump($books);
    unset($books);

?>