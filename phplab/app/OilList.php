<?php
require_once('BaseList.php');
require_once('Oil.php');
class OilList extends BaseList{
    public function add($params){
        $this->lastId++;
        $elem=new Oil($this->lastId,$params['commonName'],$params['oilType'],$params['purpose'],$params['properties']);
        array_push($this->list, $elem);
    }
    public function update($params){
        for ($i=0;$i<count($this->list);$i++){
            if($this->list[$i]->getId()==$params['id']){
                $this->list[$i]->update($params['commonName'],$params['oilType'],$params['purpose'],$params['properties']);
                break;
            }
        }
    }
    public function getAsJSON(){
        $content='{
    "oils": [';
        for ($i=0;$i<count($this->list);$i++){
            $content.=$this->list[$i]->getAsJSON().",";
        }
        $content = substr($content, 0, -1);
        $content.='    ]
        }';
        return $content;
    }
    public function getAsXML(){
        $content='<oils>
        ';
        for ($i=0;$i<count($this->list);$i++){
            $content.=$this->list[$i]->getAsXML();
        }
        $content.='</oils>';
        return $content;
    }
    public function readFromCSV($filePath){
        $fp = fopen($filePath, 'r');
        if ($fp === false) {
            die('Error: Cannot open the CSV file.');
        }
        while (($row = fgetcsv($fp,10000,",","`","\\")) !== false) {
            $this->add(['commonName'=>$row[0], 'oilType'=>$row[1],'purpose'=>$row[2],'properties'=>$row[3]]);
        }
        fclose($fp);
    }
    
}