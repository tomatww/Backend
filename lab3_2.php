<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- Базові класи (як у прикладі) ---

abstract class BaseEntity{
    protected $id;
    public abstract function display();
	public abstract function update($params);
	public function getId(){
		return $this->id;
	}
}

abstract class BaseList{
	protected $lastId;
	protected $list;
	public function __construct(){
		$this->lastId=1;
		$this->list=array();
	}
	public abstract function add($params);
	public function display(){
		for($i=0;$i<count($this->list);$i++){
			$this->list[$i]->display();
		}
	}
	public function update($params){
		for($i=0;$i<count($this->list);$i++){
			if($this->list[$i]->getId()==$params['id']){
				$this->list[$i]->update($params);
				break;
			}
		}
	}
	public function delete($id){
		for($i=0;$i<count($this->list);$i++){
			if($this->list[$i]->getId()==$id){
				array_splice($this->list,$i,1);
				break;
			}
		}
	}
}

// --- Класи сутностей ---

class OilType extends BaseEntity{
    private $name;
    public function __construct($params){
        $this->id=$params['id'];
        $this->name=$params['name'];
    }
    public function display(){
        echo $this->id.". ".$this->name."</br>";
    }
    public function update($params){
        $this->id=$params['id'];
        $this->name=$params['name'];
    }
    public function __destruct(){
        $this->id=null;
        $this->name=null;
    }
}

class Purpose extends BaseEntity{
    private $name;
    public function __construct($params){
        $this->id=$params['id'];
        $this->name=$params['name'];
    }
    public function display(){
        echo $this->id.". ".$this->name."</br>";
    }
    public function update($params){
        $this->id=$params['id'];
        $this->name=$params['name'];
    }
    public function __destruct(){
        $this->id=null;
        $this->name=null;
    }
}

class Property extends BaseEntity{
    private $name;
    private $units;
    public function __construct($params){
        $this->id=$params['id'];
        $this->name=$params['name'];
		$this->units=$params['units'];
    }
    public function display(){
        echo $this->id.". ".$this->name." <i>(".$this->units.")</i></br>";
    }
    public function update($params){
        $this->id=$params['id'];
        $this->name=$params['name'];
		$this->units=$params['units'];
    }
    public function __destruct(){
        $this->id=null;
        $this->name=null;
        $this->units=null;
    }
}

class Oil extends BaseEntity{
    private $commonName;
    private $oilType;
    private $purpose;
    private $properties;

    public function __construct($params){
        $this->id=$params['id'];
        $this->commonName=$params['commonName'];
        $this->oilType=$params['oilType'];
        $this->purpose=$params['purpose'];
        $this->properties=$params['properties'];
    }
    
    public function display(){
        echo $this->id.". <b>".$this->commonName."</b></br>";
        echo "Тип: <i>".$this->oilType."</i></br>";
        echo "Призначення: <i>".$this->purpose."</i></br>";
        echo "<b>Характеристики:</b></br>";
        $props = json_decode($this->properties);
        if ($props) {
            foreach ($props as $propertyName => $propertyValue) {
                echo $propertyName . ": " . $propertyValue . "</br>";
            }
        } 
    }

    public function update($params){
        $this->id=$params['id'];
        $this->commonName=$params['commonName'];
        $this->oilType=$params['oilType'];
        $this->purpose=$params['purpose'];
        $this->properties=$params['properties'];
    }
    
    public function __destruct(){
        $this->id=null;
        $this->commonName=null;
        $this->oilType=null;
        $this->purpose=null;
        $this->properties=null;
    }
}

class OilTypeList extends BaseList{
	public function add($params){
		$params['id']=$this->lastId;
		$newObj=new OilType($params);
		array_push($this->list,$newObj);
		$this->lastId++;
	}
}

class PurposeList extends BaseList{
	public function add($params){
		$params['id']=$this->lastId;
		$newObj=new Purpose($params);
		array_push($this->list,$newObj);
		$this->lastId++;
	}
}

class PropertyList extends BaseList{
	public function add($params){
		$params['id']=$this->lastId;
		$newObj=new Property($params);
		array_push($this->list,$newObj);
		$this->lastId++;
	}
}

class OilList extends BaseList{
	public function add($params){
		$params['id']=$this->lastId;
		$newObj=new Oil($params);
		array_push($this->list,$newObj);
		$this->lastId++;
	}
}

// Основний сценарій роботи з каталогом Олій
$c = new OilList();

// Додаємо Олію 1
$c->add(
	[
		'commonName' => 'Арганова олія Gold',
		'oilType'    => 'Рослинні олії',
		'purpose'    => 'для волосся',
		'properties' => '{"Бренд":"ArganLife", "Об\'єм":"50 мл", "Країна":"Марокко", "Ціна":"400 грн"}'
	]
);

// Додаємо Олію 2
$c->add(
	[
		'commonName' => 'Лавандова олія',
		'oilType'    => 'Ефірні олії',
		'purpose'    => 'для обличчя',
		'properties' => '{"Бренд":"AromaZone", "Об\'єм":"10 мл", "Країна":"Франція", "Ціна":"220 грн"}'
	]
);

echo "<h3>Початковий список:</h3>";
$c->display();

// Оновлюємо Олію 1 (Змінюємо назву, ціну та об'єм)
$c->update(
	[
		'id'         => '1',
		'commonName' => 'Арганова олія Platinum',
		'oilType'    => 'Рослинні олії',
		'purpose'    => 'для волосся',
		'properties' => '{"Бренд":"ArganLife", "Об\'єм":"100 мл", "Країна":"Марокко", "Ціна":"750 грн"}'
	]
);

echo "<h3>Після оновлення (ID 1):</h3>";
$c->display();

// Видаляємо Олію 2
$c->delete(2); // Видаляємо Лавандову олію (у якої ID став 2)

echo "<h3>Після видалення (ID 2):</h3>";
$c->display();
?>