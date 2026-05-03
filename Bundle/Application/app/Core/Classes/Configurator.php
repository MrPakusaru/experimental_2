<?php

namespace App\Core\Classes;

use App\Core\Exceptions\ConfigException;
use App\Models\ModelCore;
use Exception;

class Configurator
{
    private ModelConfiguration $configuration;

    /**
     * @param ModelCore $model
     * @throws Exception
     */
    public function __construct(
        private readonly ModelCore $model
    ) {
    }

    /**
     * @return void
     * @throws Exception
     */
    public function configure(): void
    {
        $this->resolveConfigData();
        $this->resolveCoreParams();

    }

    /**
     * @return void
     * @throws Exception
     */
    private function resolveConfigData(): void
    {
        if (!isset($this->model->config)) {
            throw new ConfigException(static::class, 'Отсутствует привязка к конфигурации модели');
        }
        if (!is_string($this->model->config)) {
            $type = gettype($this->model->config);
            throw new ConfigException(static::class, "Поле 'config': ожидаемый тип 'string', получено '{$type}'");
        }
        $this->configuration = new ModelConfiguration($this->model->config);
    }

    /**
     * @return void
     */
    private function resolveCoreParams(): void
    {
        $coreData = $this->configuration->getCoreData();
        $tableName = $coreData['table'];
        $this->model->setTable($tableName);
    }
    private function resolveFieldsParams()
    {
//        $fields = $this->getFieldsData();
//        foreach ($fields as $name => $params) {
//            dump($name, $params); //TODO заполнение полей
//        }
    }

    private function resolveRelationsParams()
    {

    }
}
