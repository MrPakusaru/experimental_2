<?php

namespace App\Core\Classes;

use App\Models\ModelCore;
use Exception;

class Assertor
{
    /**
     * @var array
     */
    private array $configData = [];

    /**
     * @param string $class
     * @param string $config
     */
    public function __construct(
        public string $class,
        public string $config
    ) {
        $this->setConfigData();
    }

    /**
     * @param ModelCore $model
     * @return void
     * @throws Exception
     */
    public function assert(ModelCore $model): void
    {



        $tableName = $this->getCoreData('table');
        $model->setTable($tableName);

        $fields = $this->getFieldsData();
        foreach ($fields as $name => $params) {
            dump($name, $params, $this->class); //TODO заполнение полей
        }
    }

    /**
     * @return void
     */
    private function setConfigData(): void
    {
        $this->configData = config("models.{$this->config}", []);
    }

    /**
     * @param string $coreFieldName
     * @return mixed
     * @throws Exception
     */
    private function getCoreData(string $coreFieldName = ''): mixed
    {
        $this->checkConfigNode('core');
        if ($coreFieldName === '') {
            return $this->configData['core'];
        }

        $this->checkNode($coreFieldName, $this->configData['core']);
        return $this->configData['core'][$coreFieldName];
    }

    /**
     * @return array
     * @throws Exception
     */
    private function getFieldsData(): array
    {
        $this->checkConfigNode('fields');
        return $this->configData['fields'];
    }

    /**
     * @return array
     * @throws Exception
     */
    private function getRelationsData(): array
    {
        $this->checkConfigNode('relations');
        return $this->configData['relations'];
    }

    /**
     * @throws Exception
     */
    private function checkConfigNode(string $nameNode): void
    {
        if (!isset($this->configData[$nameNode])) {
            throw new Exception("В конфигурации модели [{$this->class}] отсутствует раздел [{$nameNode}]!"); //TODO: доделать ошибки
        }
    }
    /**
     * @throws Exception
     */
    private function checkNode(string $nameNode, array $data): void
    {
        if (!isset($data[$nameNode])) {
            throw new Exception("В конфигурации модели [{$this->class}] отсутствует поле [{$nameNode}]!"); //TODO: доделать ошибки
        }
    }
}
