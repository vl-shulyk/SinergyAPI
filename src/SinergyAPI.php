<?php

declare(strict_types = 1);
namespace Sinergy;

trait SinergyAPI{
    // Трейт, формирующий GET/POST запросы к Sinergy
    use SinergyRequest;
    
    // Трейт, авторизация
    use SinergyAuth;

}