<?php

namespace Fifth\Generator\Http\Requests;


use Fifth\Generator\Common\BaseModel;

abstract class DataPersistRequest extends BaseRequest
{
    public $fileNames = [];
    private $storePath = BaseModel::ATTACHMENTS_PATH;

    public abstract function persist();

    public function storeFilesIfExists(): array
    {
        $filePaths = [];
        foreach ($this->fileNames as $fileName => $storeName){
            if (is_int($fileName)) {
                $fileName = $storeName;
            }
            if ($this->hasFile($fileName)) {
                $path = $this->file($fileName)->store($this->storePath);
                $filePaths[$storeName] = pathinfo($path)['basename'];
            }
        }

        return $filePaths;
    }

    public function getResponseMessage(): array
    {
        return ['message' => $this->getMessage()];
    }

    protected function getMessage(): string
    {
        return 'Data successfully persisted';
    }

    protected function getMergingData(): array
    {
        return [];
    }

    protected function getProcessedData(array $exceptItems = [], bool $storeFiles = true): array
    {
        return array_merge($this->except($exceptItems),
            ($storeFiles) ? $this->storeFilesIfExists() : [],
            $this->getMergingData());
    }

    public function is_assoc(array $array): bool
    {
        $keys = array_keys($array);

        return array_keys($keys) !== $keys;
    }
}

