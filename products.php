<?php 

include_once 'db.php';

class Products extends DB{

    private $currentlyPage;
    private $totalPages;
    private $nResults;
    private $pageResults;
    private $index;
    private $error=false;

    function __construct($nxpage){
        parent::__construct();

        $this->pageResults=$nxpage;
        $this->index=0;
        $this->currentlyPage=1;

        $this->calculatePages();
    }

    function calculatePages(){

        $query=$this->connect()->query('SELECT COUNT(*) AS total FROM products');
        $this->nResults = $query->fetch(PDO::FETCH_OBJ)->total;
        $this->totalPages = round($this->nResults/$this->pageResults);

        if (isset($_GET['page'])) {

            if (is_numeric($_GET['page'])) {
                if ($_GET['page'] >= 1 && $_GET['page'] <= $this->totalPages) {
                    $this->currentlyPage = $_GET['page'];
                    $this->index = ($this->currentlyPage - 1) * ($this->pageResults);
                }else {
                    echo "This page does not exist";
                    $this->error=true;
                }
            
            }else {
                echo "Error showing the page";
                $this->error=true;
            }
            
        }

    }

    function showProducts(){
        if (!$this->error) {
            $query=$this->connect()->prepare('SELECT * FROM products LIMIT :pos, :n');
            $query->execute(['pos'=>$this->index,'n'=>$this->pageResults]);

            foreach($query as $product){
                include 'productsView.php';

            }
        }
    }

    function showPages(){
        echo "<ul>";

        for ($i=0; $i < $this->totalPages ; $i++) { 

            if (($i+1) == $this->currentlyPage) {
                $current= 'class="current"';
            }else {
                $current='';
            }
            echo '<li><a '. $current.' href="?page='.($i+1).'">'.($i+1).'</a></li>';
        }
        echo"<ul>";
    }
}

?>