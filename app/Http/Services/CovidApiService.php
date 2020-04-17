<?php


namespace App\Http\Services;

use App\Http\Model\InfectedCountry;

class CovidApiService
{

    /**
     * @var InfectedCountry
     */
    private $infectedCountry;

    /**
     * CovidApiService constructor
     * @param InfectedCountry $infectedCountry
     */
    public function __construct(InfectedCountry $infectedCountry){

        $this->infectedCountry = $infectedCountry;

    }

    /**
     * @param string $url
     * @return mixed
     *
     */
    public function download(string $url): ?array{


        $this->curlHandle = curl_init();
        curl_setopt($this->curlHandle, CURLOPT_URL, $url);
        curl_setopt($this->curlHandle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, 1);

        $receivedData = json_decode(curl_exec($this->curlHandle),true);
        curl_close($this->curlHandle);

        return $receivedData;

    }

    public function parseData(?array $data, ?string $inputHandler ){

        if(!empty($data) && !empty($inputHandler)){

            $inputHandler = ucwords($inputHandler);

            if (!key_exists($inputHandler, $data)){
                return null;
            }
            $parsedData = [];

            foreach ($data[$inputHandler] as $dataDay){
                $this->infectedCountry->setDate($dataDay);
                $parsedData[]=[
                    'date'=>$this->infectedCountry->date,
                    'confirmed'=>$this->infectedCountry->confirmed,
                    'deaths'=>$this->infectedCountry->deaths,
                    'recovered' => $this->infectedCountry->recovered
                ];
            }
            return $parsedData;
        }
        return null;
    }
}
