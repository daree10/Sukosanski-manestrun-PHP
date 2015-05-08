<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        class Sastojak
        {
            protected $kolicina;
            protected $naziv;
            protected $narezano;
            
            function __construct($naziv, $kolicina)
            {
                $this->naziv = $naziv;
                $this->kolicina = $kolicina;
                $this->narezano = false;
               
            }
            
            public function getNaziv()
            {
                return $this->naziv;
            }
            
            public function narezi()
            {
                $this->narezano = true;
            }
        }
        
        class Povrce extends Sastojak
        {
            private $skuhano;
            
            function __construct($naziv, $kolicina)
            {
                parent::__construct($naziv, $kolicina);
                $this->skuhano = false;
            }
            public function isSkuhano()
            {
                return $this->skuhano;
            }
            public function skuhaj()
            {
                $this->skuhano = true;
            }
            public function getNaziv()
            {
                return "povrce: ".$this->naziv;
            }
        }
        
        class Zacin extends Sastojak
        {
            private $spicy;
            function __construct($naziv, $kolicina, $spicy) {
                parent::__construct($naziv, $kolicina);
                $this->spicy = $spicy;
            }
        }
        
        class Osoba
        {
            public $prezime;
            public $mjesto;
            function __construct($prezime, $mjesto)
            {
                $this->prezime = $prezime;
                $this->mjesto = $mjesto;
            }
        }
        
        class Mestar extends Osoba
        {
            public $godineiskustva;
            function __construct($prezime, $mjesto, $godineiskustva) {
                parent::__construct($prezime, $mjesto);
                $this->godineiskustva = $godineiskustva;
            }
            
            public function nareziSastojak(Sastojak $sastojak)
            {
                $sastojak->narezi();
            }
            
            public function dinstaj(Sastojak $sastojak1,Sastojak $sastojak2,Povrce $sastojak3,Povrce $povrceZaDinstanje, $vrijeme)
            {
                if($sastojak1->getNaziv() != "maslinovo ulje" || $sastojak2->getNaziv() != "panceta" || $sastojak3.getNaziv()!= "pomidor" || $vrijeme < 0 || $vrijeme > 5)
                {
                    return array("aj","kuci","sto","zezas","mestra");
                }

                $mestrovoNovoVrijeme = rand($vrijeme, 10); // je, ti ces mestru govorit kolko da dinsta, kako neces
                
                echo "dodajem: ".$sastojak1->getNaziv()."...<br>";
                echo "dodajem: ".$sastojak2->getNaziv()."...<br>";
                
                $i = 0;
                $dinstanoPovrce = array($sastojak1->getNaziv(),$sastojak2->getNaziv());
                while($i < $mestrovoNovoVrijeme)
                {
                    foreach($povrceZaDinstanje as $povrce)
                    {
                        echo "dinsta se: ".$povrce->getNaziv()."...<br>";
                        if($i==0){array_push($dinstanoPovrce, $povrce->getNaziv());}
                    }
                    $i++;
                }
                echo "dodajem: ".$sastojak3->getNaziv();
                
                return $dinstanoPovrce."...";
            }
            
            public function kuhaj(Povrce $dinstanoPovrce,Sastojak $sastojak,Sastojak $sastojak2,$vrijeme = 30)
            {
                if($sastojak->getNaziv() != "rezanci" || $sastojak2->getNaziv() != "voda")
                {
                    return array("aj","prestani","daj","mi","pastu","ili","idjen","kuc");
                }
                
                $manestrun = array($sastojak->getNaziv(),$sastojak2->getNaziv());
                for($i = 0;$i<$vrijeme;$i++)
                {
                    $poruka = "kuhaju se ".$sastojak." i ";
                    foreach($dinstanoPovrce as $povrce)
                    {
                        $poruka .= $povrce->getNaziv()." "; 
                        $povrce->skuhaj();
                        array_push($manestrun,$povrce->getNaziv());
                    }
                    $poruka .= "...<br>";
                    echo $poruka;
                }
                return $manestrun;
            }
            
            public function zacini(Sastojak $manestrun,Zacin $zacini)
            {
                $poruka = "dodajem malo ";
                foreach($zacini as $zacin)
                {
                    $poruka .= $zacin->getNaziv()." ";
                    array_push($manestrun,$zacin->getNaziv());
                }
           
                return $manestrun;
            }
        }
        
        $kuhar = new Mestar("Grginovic", "Sukosan", "10");
        
        
        
        
        
        
        $zacin = new Zacin("persin","bokun", false);
                $zacin2 = new Zacin("luk","2 komada",true);
        
        
        
        
        ?>
    </body>
</html>
