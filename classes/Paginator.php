<?php

Class Paginator {
    
    public $htmlPaginator = "Pages:&nbsp;";
    public $htmlMessages;
    public $htmlCounter;
    private $dataDir = "data/data.txt";
    private $data;
    private $pageNum;
    private $mesNum;
    private $dataEncode;
    

    public function __construct($pageNum = 1, $mesNum = 5) {
        $this->pageNum = $pageNum;
        $this->mesNum = $mesNum;
        $this->data = file($this->dataDir);
    }

    public function makePaginator() {
        $pages = (int) count($this->data) / $this->mesNum + 1;
        for ($i = 1; $i <= $pages; $i++) {
            if ($i == $this->pageNum) {
                $this->htmlPaginator .= "&nbsp;" . $i . "&nbsp;";
            } else {
                $this->htmlPaginator .= "&nbsp;<a href=index.php?page=" . $i . ">" . $i . "</a>&nbsp;";
            }
        }
    }

    public function getMessages() {
        $this->getData();
        $this->dataDecode = array_reverse($this->dataDecode);
        $startIndex = ($this->pageNum - 1) * $this->mesNum;
        $currentMess = array_slice($this->dataDecode, $startIndex, $this->mesNum);
        for ($i = 0; $i < count($currentMess); $i++) {
            $this->htmlMessages .= " <div class='m'>";
            $this->htmlMessages .= "<blockquote>";
            $this->htmlMessages .= "<p>" . $currentMess[$i]['message'] . "</p>";
            $this->htmlMessages .= "<footer>" . $currentMess[$i]['user'] . "</footer>";
            $this->htmlMessages .= "</blockquote>";
            $this->htmlMessages .= "</div>";
        }
    }

    private function getData() {
        foreach ($this->data as $value) {

            $this->dataDecode[] = json_decode($value, true);
        }
    }

    public function getCounter() {
        $this->htmlCounter .= "<form action = 'index.php' method='get'>";
        $this->htmlCounter .= "<select id='myselect' onchange='submit()' name='mesNum' class='form-control col-xs-1'>";
        ($this->mesNum == 5) ? $this->htmlCounter .= "<option selected>5</option>" : $this->htmlCounter .= "<option >5</option>";
        ($this->mesNum == 10) ? $this->htmlCounter .= "<option selected>10</option>" : $this->htmlCounter .="<option >10</option>";
        ($this->mesNum == 15) ? $this->htmlCounter .= "<option selected>15</option>" : $this->htmlCounter .="<option >15</option>";
        $this->htmlCounter .= "</select>";
        $this->htmlCounter .= "</form>";
    }

}
