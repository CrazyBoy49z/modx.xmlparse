<?php

define('filepathxml', '/opt/local/www/realty.local/assets/products.xml');

//запустить импорт коллекций или нет
define('Go',false);
//Определить свои ID шаблонов для ипорта
define('BuildersID', '');
define('BanksID', '');
define('TownareasID', '');
define('StreetsID', '');
define('MetrosID', ''); 
define('ReadinessesID', '');
define('BuildingTypesID', '');
define('FacingsID', '');
define('ApartmentTypesID', '');
define('RoomNumbersID', '');
define('DistrictsID', '');
define('NearMetrosID', '');
define('PaymentTypesID', '');


class importXML
{
    public $xml;
    public $collections = array();
    //Если нужен импорт коллекций включить true для перебора коллекций в importCollection;
    protected $toggle = false;
    public function __construct($filepath)
    {
        $this->xml = simplexml_load_file($filepath);
    }
    
    public function import()
    {       
        // инициализация MODX API
        define('MODX_API_MODE', true);
        require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/core/config/config.inc.php';
        require_once MODX_BASE_PATH . 'index.php';
        // Включаем обработку ошибок
        $modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');
        $modx->setLogLevel(modX::LOG_LEVEL_ERROR);
        $modx->getService('error','error.modError');
        // $modx->lexicon->load('minishop2:default');
        // $modx->lexicon->load('minishop2:manager');
        $modx->error->message = null; // Обнуляем переменную
        
        //инициируем массив коллекций
        $this->collections = array(
                'Builders' => $this->xml->builders->builder,
                // 'Banks' => $this->xml->banks->bank,
                // 'Townareas' =>$this->xml->townareas->townarea,
                // 'Streets' =>$this->xml->streets->street,
                // 'Metros' =>$this->xml->metros->metro,
                // 'Readinesses' => $this->xml->readinesses->readiness,
                // 'BuildingTypes'=>$this->xml->buildingTypes->buildingType,
                // 'Facings' => $this->xml->facings->facing,
                // 'ApartmentTypes'=>$this->xml->apartmentTypes->apartmentType,
                // 'RoomNumbers'=>$this->xml->roomNumbers->roomNumber,
                // 'Districts'=>$this->xml->districts->district,
                // 'NearMetros'=>$this->xml->nearMetros->nearMetro,
                // 'PaymentTypes'=>$this->xml->paymentTypes->paymentType
            );
        /*
        Блок для разбора массива коллекция, если они отсутствуют
        */
        if (Go == true)
        {
            //Начинаем перебор массива коллекций
            foreach($this->collections as $collection=>$items)
            {
                //Создаем коллекцию и разбираем результат запроса
                $array = array(
                    'parent'=> 0,
                    'pagetitle' => $collection,
                    'class_key'=>'CollectionContainer',
                    'alias' => $collection,
                	'published' => 1
                 );
                 $response = $modx->runProcessor('resource/create', $array);
                 $collection = $response->getResponse();
                //  Если создание коллекции успешно, то извлекаем id
                if ($collection['success'] == true) {
                    $collection_id = $collection['object']['id'];
                    echo "Успешно создана коллекция c ID -" . $collection['object']['id'] . "<br>";
                //если такая коллекция есть, то ищем id в строке ответа
                } else {
                    echo '<pre>';
                    print_r ($collection['errors']);
                    echo '<pre>';
                }
            } 
        }
         /*
        Конец блока для расбора массива коллекций
        */
        
        
        /*
        Начало блока для разбора коллекций
        */
        /*
        Блок для разбора добавление ресурсов в коллекцию банков
        */
        if (BanksID !== ''){
            foreach($this->collections['Banks'] as $resource)
            {
                $newResource = array(
                            'parent' => BanksID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
        /*
        Блок для добавления ресурсов в коллекцию застройщиков
        */
        if (BuildersID !== ''){
            foreach($this->collections['Builders'] as $resource)
            {
                $newResource = array(
                            'parent' => BuildersID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
         /*
        Блок для добавления ресурсов в коллекцию районов
        */
        if (TownareasID !== ''){
            foreach($this->collections['Townareas'] as $resource)
            {
                $newResource = array(
                            'parent' => TownareasID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
         /*
        Блок для добавления ресурсов в коллекцию улиц
        */
        if (StreetsID !== ''){
            foreach($this->collections['Streets'] as $resource)
            {
                $newResource = array(
                            'parent' => StreetsID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
        /*
         Блок для добавления ресурсов в коллекцию метро
        */
        if (MetrosID !== ''){
            foreach($this->collections['Metros'] as $resource)
            {
                $newResource = array(
                            'parent' => MetrosID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
        /*
         Блок для добавления ресурсов в коллекцию статуса готовности
        */
        if (ReadinessesID !== ''){
            foreach($this->collections['Readinesses'] as $resource)
            {
                $newResource = array(
                            'parent' => ReadinessesID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
        /*
         Блок для добавления ресурсов в коллекцию типаОбъекта
        */
        if (BuildingTypesID !== ''){
            foreach($this->collections['BuildingTypes'] as $resource)
            {
                $newResource = array(
                            'parent' => BuildingTypesID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
        /*
         Блок для добавления ресурсов в коллекцию типаОтделки
        */
        if (FacingsID !== ''){
            foreach($this->collections['Facings'] as $resource)
            {
                $newResource = array(
                            'parent' => FacingsID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
        /*
         Блок для добавления ресурсов в коллекцию типаСделки
        */
        if (ApartmentTypesID !== ''){
            foreach($this->collections['ApartmentTypes'] as $resource)
            {
                $newResource = array(
                            'parent' => ApartmentTypesID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
         /*
         Блок для добавления ресурсов в коллекцию типаСделки
        */
        if (RoomNumbersID !== ''){
            foreach($this->collections['RoomNumbers'] as $resource)
            {
                $newResource = array(
                            'parent' => RoomNumbersID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
         /*
         Блок для добавления ресурсов в коллекцию района
        */
        if (DistrictsID !== ''){
            foreach($this->collections['Districts'] as $resource)
            {
                
                //разобрать что здесь происходит;
                $newResource = array(
                            'parent' => DistrictsID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
        /*
         Блок для добавления ресурсов в коллекцию удМетро
        */
        if (NearMetrosID !== ''){
            foreach($this->collections['NearMetros'] as $resource)
            {
                //разобрать что здесь происходит;
                $newResource = array(
                            'parent' => NearMetrosID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
         /*
         Блок для добавления ресурсов в коллекцию платСистем
        */
        if (PaymentTypesID !== ''){
            foreach($this->collections['PaymentTypes'] as $resource)
            {
                //разобрать что здесь происходит;
                $newResource = array(
                            'parent' => PaymentTypesID,
                            'pagetitle' => $resource->title,
                            'published'=> true,
                            );
                $result = $modx->runProcessor('resource/create', $newResource); 
                $res = $result->getResponse();
            }
        }
        
        /*
        Конец блока для добавления ресурсов в коллекции
        */
        
    }
}

$import = new importXML(filepathxml);
$import->import();