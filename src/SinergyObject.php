<?php

declare(strict_types=1);

namespace Sinergy;

abstract class SinergyObject
{
    public $data = [];
    // public $dealdata = [];
    const URL = '';
    /**
     * Конструктор
     * @param array $params Параметры модели
     * @param string $subdomain Поддомен amoCRM
     */
    public function __construct(array $params = [])
    {
        $this->fill($params);
    }

    /**
     * Заполняет модель значениями из массива data
     * @param array $params Параметры модели
     * @return void
     */
    protected function fill(array $params = [])
    {   
        foreach ($params as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
    public function genData($type){
        $data = [
            'data' => [
                'type' => $type,
            ]
        ];
        return $data;
    }

    public function save(){
        $params = $this->data;
        if(isset($params['data']['id'])){

        }else{
            $result = SinergyAPI::request($this::URL, 'POST', $params);
        }
        // ['respone']['data']['id']
        
        return $result['respone']['data']['id'];
    }
}
