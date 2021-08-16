<?php

declare(strict_types=1);

namespace Sinergy;

class SinergyContact extends SinergyObject
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

    

    public function setAtributes(array $params = [])
    {
        $data = parent::genData('contacts');
        foreach ($params as $key => $value) {
            $data['data']['attributes'][$key] = $value;
            
        }
        $this->data = $data;
        return $this->data;
    }

    public function setResponsible(string $responsible_id = null)
    {
        # code...
        if($responsible_id !=''){
            $this->data['data']['relationships']['responsible']['data'] = [
                'type' => 'users',
                'id' => $responsible_id
            ];
            
            return $this->data;
        }

    }
    


}
