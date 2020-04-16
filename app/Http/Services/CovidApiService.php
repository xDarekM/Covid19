<?php


namespace App\Http\Services;

use App\Http\Model\InfectedCountry;

class CovidApiService
{
    /**
     * @var InfectedCountry
     */
    private $infectedCountry;


    public function _construct(InfectedCountry $infectedCountry){
        $this->infectedCountry= $infectedCountry;
    }
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

            if (key_exists($inputHandler,$data)){
                return null;
            }
            $parsedData = [];

            foreach ($data[$inputHandler] as $dataDay){
                $this->infectedCountry->setDate($dataDay);
                $parsedData[]=[
                    'date'=>$this->infectedCountry->date,
                    'recovered'=>$this->infectedCountry->recovered,
                    'confirmed'=>$this->infectedCountry->confirmed,
                    'deaths'=>$this->infectedCountry->deaths,
                ];
            }
            return $parsedData;
        }
        return null;
    }
}
