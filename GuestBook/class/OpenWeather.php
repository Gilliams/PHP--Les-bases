<?php

namespace App;

use DateTime;
use App\Exception\CurlException;
use App\Exception\HTTPException;
use App\Exception\UnauthorizedHTTPException;


/**
 * Gère l'API d'OpenWeather
 * 
 * @author Florian Andrieux <gilliams9@hotmail.fr
 */
class OpenWeather{
    
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }
    
    /**
     * getToday
     *
     * @param  string $city
     * @return array
     */
    function getToday(string $city):?array
    {
        // try{
            $data = $this->callAPI("weather?q={$city}");
        // }catch(Exception $e){
        //     return [
        //         'temp' => 0,
        //         'description' => "Meteo indisponible",
        //         'date' => new DateTime()
        //     ];
        // }
        return [
            'temp' => $data['main']['temp'],
            'description' => $data['weather'][0]['description'],
            'date' => new DateTime()
        ];
    }    
    /**
     * Récupére les informations sur plusieurs jours toutes les 3h
     *
     * @param  string $city (ex: "Reims,fr")
     * @return array
     */
    public function getForecast(string $city): ?array
    {
        // try{
            $data = $this->callAPI("forecast?q={$city}");
        // }catch(Exception $e){
        //     return [];
        // }
        foreach($data['list'] as $day){
            $result[] = [
                'temp' => $day['main']['temp'],
                'description' => $day['weather'][0]['description'],
                'date' => new DateTime('@' . $day['dt'])
            ];
        }
        return $result;
    }
   
   /**
    * Appel l'api OpenWeather
    *
    * @param  string $endpoint Action à appeler (ex: "forecast?q={$city}")
    * @throws CurlException Curl a rencontré une erreur
    * @throws UnauthorizedHTTPException Problème avec l'API
    * @return array
    */
   private function callAPI(string $endpoint): ?array
   {
       
    $curl = curl_init("api.openweathermap.org/data/2.5/{$endpoint}&appid={$this->key}&lang=fr&units=metric");
    curl_setopt_array($curl,[
        CURLOPT_CERTINFO => __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR .'Cert.cer',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 1,
    ]);
    $data = curl_exec($curl);
    if($data === false){
        throw new CurlException($curl);
        // $error = curl_error($curl);
        // curl_close($curl);
        // throw new Exception($error);
    }
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if( $code !== 200){
        curl_close($curl);
        if($code === 401){
            $data = json_decode($data,true);
            throw new UnauthorizedHTTPException($data['message'],401);
        }
        throw new HTTPException($data, $code);
    }
    return json_decode($data, true);
    
    curl_close($curl);
   }
}