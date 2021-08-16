<?php

declare(strict_types=1);

namespace Sinergy;

class SinergyFilter extends SinergyObject
{
    const URL = '/api/v1/contacts';

    public $stage_id;

    public $responsible_id;

    /**
     * Конструктор
     * @param array $data Параметры модели
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function filter(string $phone, $field = 'any-phone')
    {
        if ($phone != '') {


            $data = [
                "filter" => [
                    "{$field}" => "{$phone}",
                ]
            ];

            $result = SinergyAPI::request($this::URL, 'GET', $data);
            
            return $result['respone']['data'];
        }else{

            $result = SinergyAPI::request($this::URL, 'GET');
            return $result;
        }
    }

    


}
