<?php

class Sastojak {

    protected $kolicina;
    protected $naziv;
    protected $narezano;

    function __construct($naziv, $kolicina) {
        $this->naziv = $naziv;
        $this->kolicina = $kolicina;
        $this->narezano = false;
    }

    public function getNaziv() {
        return $this->naziv;
    }

    public function narezi() {
        $this->narezano = true;
    }

}

class Povrce extends Sastojak {

    private $skuhano;

    function __construct($naziv, $kolicina) {
        parent::__construct($naziv, $kolicina);
        $this->skuhano = false;
    }

    public function isSkuhano() {
        return $this->skuhano;
    }

    public function skuhaj() {
        $this->skuhano = true;
    }

    public function getNaziv() {
        return "povrce: " . $this->naziv;
    }

}

class Zacin extends Sastojak {

    private $spicy;

    function __construct($naziv, $kolicina, $spicy) {
        parent::__construct($naziv, $kolicina);
        $this->spicy = $spicy;
    }

}

class Osoba {

    public $prezime;
    public $mjesto;

    function __construct($prezime, $mjesto) {
        $this->prezime = $prezime;
        $this->mjesto = $mjesto;
    }

}

class Mestar extends Osoba {

    public $godineiskustva;

    function __construct($prezime, $mjesto, $godineiskustva) {
        parent::__construct($prezime, $mjesto);
        $this->godineiskustva = $godineiskustva;
    }

    public function nareziSastojak(Sastojak $sastojak) {
        $sastojak->narezi();
        echo "Narezao sam " . $sastojak->getNaziv() . "...<br>";
    }

    public function dinstaj(Sastojak $sastojak1, Sastojak $sastojak2, Povrce $sastojak3, $povrceZaDinstanje, $vrijeme) {
        if ($sastojak1->getNaziv() != "maslinovo ulje" || $sastojak2->getNaziv() != "panceta" || $sastojak3->getNaziv() != "povrce: pomidor" || $vrijeme < 0 || $vrijeme > 5) {
            return array("aj", "kuci", "sto", "zezas", "mestra");
        }

        $mestrovoNovoVrijeme = rand($vrijeme, 10); // je, ti ces mestru govorit kolko da dinsta, kako neces

        echo "dodajem: " . $sastojak1->getNaziv() . "...<br>";
        echo "dodajem: " . $sastojak2->getNaziv() . "...<br>";

        $i = 0;
        $dinstanoPovrce = array($sastojak1, $sastojak2);
        while ($i < $mestrovoNovoVrijeme) {
            foreach ($povrceZaDinstanje as $povrce) {
                echo "dinsta se: " . $povrce->getNaziv() . "...<br>";
                if ($i == 0) {
                    array_push($dinstanoPovrce, $povrce);
                }
            }
            $i++;
        }
        echo "dodajem: " . $sastojak3->getNaziv()."<br><br>";

        return $dinstanoPovrce;
    }

    public function kuhaj($dinstanoPovrce, Sastojak $sastojak, Sastojak $sastojak2, $vrijeme = 30) {
        if ($sastojak->getNaziv() != "rezanci" || $sastojak2->getNaziv() != "voda") {
            return array("aj", "prestani", "daj", "mi", "pastu", "ili", "idjen", "kuc");
        }

        $manestrun = array($sastojak, $sastojak2);
        for ($i = 0; $i < $vrijeme; $i++) {
            $poruka = "kuhaju se " . $sastojak->getNaziv() . " i ";
            foreach ($dinstanoPovrce as $povrce) {
                $poruka .= $povrce->getNaziv() . " ";
                if($povrce instanceof Povrce){$povrce->skuhaj();}
                if ($i == 0) {array_push($manestrun, $povrce);}
            }
            $poruka .= "...<br>";
            echo $poruka;
        }
        return $manestrun;
    }

    public function zacini($manestrun, $zacini) {
        $poruka = "dodajem malo ";
        foreach ($zacini as $zacin) {
            $poruka .= $zacin->getNaziv() . " ";
            array_push($manestrun, $zacin);
        }

        return $manestrun;
    }

}

/*
 * Tu sad pocinjemo kuhati!
 */

$kuhar = new Mestar("Grginovic", "Sukosan", "10");

$maslinovoUlje = new Sastojak("maslinovo ulje", "1dcl");
$panceta = new Sastojak("panceta", "3dag");
$kapula = new Povrce("kapula", "15dag");
$mrkva = new Povrce("mrkva", "15dag");
$kumpir = new Povrce("krumpir", "5dag");

$kuhar->nareziSastojak($kapula);
$kuhar->nareziSastojak($mrkva);
$kuhar->nareziSastojak($kumpir);

$pomedor = new Povrce("pomidor", "10dag");
$kuhar->nareziSastojak($pomedor);

$povrceZaDinstati = array($kapula, $mrkva, $kumpir);
$manestrunPolaGotov = $kuhar->dinstaj($maslinovoUlje, $panceta, $pomedor, $povrceZaDinstati, 4);

$pasta = new Sastojak("rezanci","5dag");
$voda = new Sastojak("voda","6dcl");

$manestrunGotovNezacinjen = $kuhar->kuhaj($manestrunPolaGotov,$pasta,$voda);



$zaciniZaStaviti = array(new Zacin("persin", "bokun", false),new Zacin("luk", "2 komada", true));
$manestrunGutov = $kuhar->zacini($manestrunGotovNezacinjen,$zaciniZaStaviti);

echo " <br><br><br>MANESTRUN: <br>";
foreach($manestrunGutov as $sast)
{
    echo "<br><br>".$sast->getNaziv();
}

echo "<br>dobar tek :)"
/*
 * Dobar tek!
 */
?>