<?php


namespace App\Http\Model;

class InfectedCountry
{

    /**
     * @var string
     */
        public $date;
    /**
     * @var int
     */
        public $confirmed;
    /**
     * @var int
     */
        public $deaths;
    /**
     * @var int
     */
        public $recovered;


    public function setDate(?array $apiData)
    {
        $this->date = $apiData['date'] ??null;
        $this->confirmed = $apiData['confirmed'] ??null;
        $this->recovered = $apiData['recovered'] ??null;
        $this->deaths = $apiData['deaths'] ??null;
    }
}
