<?php
interface CarsTarif
{
    public function __construct($min, $km, $age);
    public function age($age);
    public function tarif();
    public function getTarif();
}


abstract class Cars implements CarsTarif
{
    public $km;
    public $min;
    public $age;
    public $gps;


    public function __construct($min, $km, $age)
    {
        $this->km = $km;
        $this->min = $min;
        $this->age = $age;
    }

    use Gps;

    public function age($age){
        if (($age<18) || ($age>65)){
            $ageKoeficient = "Error";
        }elseif(($age >= 18) && ($age <= 21)){
            $ageKoeficient = 1.1;
        }else{
            $ageKoeficient = 1;
        }
        return $ageKoeficient;
    }

    public function tarif()
    {
        $tarif = static::KM * $this->km + static::MIN*$this->min;
        $tarif = $tarif * $this->age($this->age);
        $dop = $this->gps == 1 ? $this->gps($this->min) : 0;
        $tarif += $dop;
        $tarif += $this->driver;
        return $tarif;
    }

    public function getTarif(){
        $koef = $this->age($this->age)==1.1 ? " _ коэффициент молодежный 1.1" : "";
        if ($this->age($this->age) == "Error"){
            echo "Извините, но Вы не можете воспользоваться услугой.<br>";
        }else{
            $dop = $this->gps == 1 ? ", Gps в салон - 15 рублей в час" : "";
            if ($this->driver){$dop .= ", дополнительный водитель - 100 рублей";}
            if ($dop==""){$dop = ", без доп. услуг";}
            echo static::NAME.": ($this->km км по ".static::KM." рублей плюс $this->min минут по ".static::MIN." рубля$dop)$koef = ".$this->tarif()."<br>";
        }

    }
}

class Basic extends Cars
{
    const KM = 10;
    const MIN = 3;
    const NAME = "Тариф базовый";
}

class Hourly extends Cars
{
    const KM = 0;
    const MIN = 200;
    const NAME = "Тариф почасовой";

    use Driver;

    public function __construct($min, $km, $age)
    {
        parent::__construct($min, $km, $age);
        $this->min = 60*ceil($this->min/60);
    }
}

class Daily extends Cars
{
    const KM = 1;
    const MIN = 1000;
    const NAME = "Тариф суточный";

    public function __construct($min, $km, $age)
    {
        parent::__construct($min, $km, $age);
        $sut = round  ($min/(24*60));
        $ost = $min%(24*60);
        $dop = $ost < 30 ? 0 : 1;
        $this->min = $sut + $dop;
    }

    use Driver;

    public function getTarif(){
        $koef = $this->age($this->age)==1.1 ? " _ коэффициент молодежный 1.1" : "";
        if ($this->age($this->age) == "Error"){
            echo "Извините, но Вы не можете воспользоваться услугой.<br>";
        }else{
            $dop = $this->gps == 1 ? ", Gps в салон - 15 рублей в час" : "";
            if ($this->driver){$dop .= ", дополнительный водитель - 100 рублей";}
            if ($dop==""){$dop = ", без доп. услуг";}
            echo static::NAME.": ($this->km км по ".static::KM." рублей плюс $this->min суток по ".static::MIN." рубля$dop)$koef = ".$this->tarif()."<br>";
        }

    }
}

class Student extends Cars
{
    const KM = 4;
    const MIN = 1;
    const NAME = "Тариф суточный";

    public function getTarif(){
        $koef = $this->age($this->age)==1.1 ? " _ коэффициент молодежный 1.1" : "";
        if (($this->age($this->age) == "Error") OR ($this->age >= 25)){
            echo "Извините, но Вы не можете воспользоваться услугой.<br>";
        }else{
            $dop = $this->gps == 1 ? " ,Gps в салон - 15 рублей в час" : ", без доп. услуг";
            echo static::NAME.": ($this->km км по ".static::KM." рублей плюс $this->min минут по ".static::MIN." рубля$dop)$koef = ".$this->tarif()."<br>";
        }

    }
}

trait Gps
{
    function gps($min){
        return 15*ceil($min/60);
    }
}

trait Driver
{
    protected $driver;
    public function driver($bool){
        $this->driver = $bool ? 100 : 0;
    }
}


//Дополнительные услуги (трейты):
//
//Gps в салон - 15 рублей в час, минимум 1 час. Округление в большую сторону. Доступно на всех тарифах
//Дополнительный водитель - 100 рублей единоразово, доступен на всех тарифах кроме базового и студенческого

$a = new  Basic(1, 1, 22);
$a->gps =1;
$a->getTarif();
$b = new  Basic(1, 1, 18);
$b->getTarif();
$c = new  Hourly(1, 1, 22);
$c->getTarif();
$d = new  Hourly(1, 1, 202);
$d->getTarif();
$f = new  Daily(24*60, 100, 22);
$f->driver(1);
$f->getTarif();
$g = new  Student(100, 15, 22);
$g->getTarif();
$h = new  Student(100, 15, 26);
$h->getTarif();