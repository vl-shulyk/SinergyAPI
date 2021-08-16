<?php

namespace Sinergy;

trait SinergyRequest
{
    public static $token;

    public static $baseUrl = "https://app.syncrm.ru";

    public static $userAgent = "Content-type: application/vnd.api+json;";

    public static $auth = "Authorization: Bearer ";

    public static $lastResult;

    protected static function setDefaultCurlOptions($curl)
    {

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(self::$userAgent, self::$auth . self::$token));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * Отправляет запрос к Sinergy API
     * @param string $query Путь в строке запроса
     * @param string $type Тип запроса GET|POST
     * @param array $params Параметры запроса
     */
    public static function request(string $query, string $type = 'GET', $params = [])
    {
        // Инициализируем curl и устанавливаем параметры по умолчанию
        $curl = curl_init();
        self::setDefaultCurlOptions($curl);

        $url = self::$baseUrl . $query;

        switch ($type) {
            case 'GET':
                if (count($params)) {
                    $url .= '?' . http_build_query($params);
                }
                
                break;

            case 'POST':
                $jsonParams = json_encode($params);
                if ($jsonParams === false) {
                    return false;
                }
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonParams);
                break;

                case 'DELETE':
                    $jsonParams = json_encode($params);
                    if ($jsonParams === false) {
                        return false;
                    }
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonParams);
                    break;


                
        }

        // Устанавливаем URL запроса
        curl_setopt($curl, CURLOPT_URL, $url);
       self::$lastResult = curl_exec($curl) ;
       $result['respone'] = json_decode( self::$lastResult, true);
       $result['url'] = $url;
       return $result;

    }
}
