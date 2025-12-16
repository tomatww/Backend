<?php
require_once('BaseEntity.php');
class Oil extends BaseEntity{
    private $commonName;
    private $oilType;
    private $purpose;
    private $properties;
    public function __construct($id, $commonName, $oilType, $purpose, $properties = []){
        $this->id = $id;
        $this->commonName = $commonName;
        $this->oilType = $oilType;
        $this->purpose = $purpose;
        $this->properties = $properties;
    }
    public function display(){
        echo $this->id.". ".$this->commonName."</br>";
        echo "Тип олії: <i>".$this->oilType."</i></br>";
        echo "Призначення: <b>".$this->purpose."</b></br>";
        echo "<b>Характеристики:</b></br>";
        foreach (json_decode($this->properties, true) as $propertyName => $propertyValue) {
        if (is_array($propertyValue)) {
            echo $propertyName . ": " . implode(", ", $propertyValue) . "</br>";
        } else {
            echo $propertyName . ": " . $propertyValue . "</br>";
        }
        }

    }
    public function update($commonName, $oilType, $purpose, $properties = []){
        $this->commonName = $commonName;
        $this->oilType = $oilType;
        $this->purpose = $purpose;
        $this->properties = $properties;
    }
    public function __destruct(){
        $this->id=null;
        $this->commonName=null;
        $this->oilType=null;
        $this->purpose=null;
        $this->properties=null;
    }
    public function getAsJSON(){
        return '{
            "id": "'.$this->id.'",
            "commonName": "'.$this->commonName.'",
            "oilType": "'.$this->oilType.'",
            "purpose": "'.$this->purpose.'",
            "properties": '.$this->properties.'
        }';
    }
    public function getAsXML(){
        $properties='';
        foreach (json_decode($this->properties) as $propertyName => $propertyValue) {
            if (is_array($propertyValue)) {
                $propertyValue = implode(', ', $propertyValue);
            }
            $properties.='<property>
                            <name>'.$propertyName.'</name>
                            <value>'.$propertyValue.'</value>
                        </property>';
        }
        return '<oil>
                    <id>'.$this->id.'</id>
                    <commonName>'.$this->commonName.'</commonName>
                    <oilType>'.$this->oilType.'</oilType>
                    <purpose>'.$this->purpose.'</purpose>
                    <properties>'.$properties.'</properties>
                </oil>';
    }
    public function getAsIndexedArray(){
        return [$this->commonName,$this->oilType,$this->purpose,$this->properties];
    }
}