<?php

namespace Fifth\Generator\Http\Requests;

use Fifth\Generator\Exceptions\CustomAuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    protected $replace = [];
    protected $defaults = [];
    protected $forbiddenMessages = [];
    protected $errorMessage = 'This action is unauthorized.';
    protected $errorCode = 403;
    protected $errorAction = 'default';

    public function all($keys = null)
    {
        $request = parent::all($keys);

        $this->replaceKeys($request);

        $this->setDefaults($request);

        return $request;
    }

    private function setDefaults(array &$request): void
    {
        foreach ($this->defaults as $key => $value) {
            if (!isset($request[$key])) {
                $request[$key] = $value;
                $this[$key] = $value;
            }
        }
    }

    private function replaceKeys(array &$request): void
    {
        foreach ($this->replace as $oldKey => $key) {
            if (isset($request[$oldKey])) {
                $request[$key] = $request[$oldKey];
                $this[$key] = $request[$key];
                unset($request[$oldKey]);
            }
        }
    }

    protected function beforeAuthorization(): void
    {
        //
    }

    public function authorize(): bool
    {
        $this->beforeAuthorization();

        foreach ((array)$this->authorizationRules() as $key => $value) {
            if (!$value) {
                if (isset($this->forbiddenMessages[$key])) {
                    $this->errorAction = $key ?? $this->defaultAction;
                    $this->errorMessage = ((array)$this->forbiddenMessages[$key])[0] ?? $this->errorMessage;
                    $this->errorCode = ((array)$this->forbiddenMessages[$key])[1] ?? $this->errorCode;
                }

                return false;
            }
        }

        return true;
    }

    protected function authorizationRules()
    {
        return [];
    }

    protected function failedAuthorization()
    {
        throw new CustomAuthorizationException(...$this->forbiddenResponse());
    }

    public function forbiddenResponse(): array
    {
        return [[$this->errorAction => $this->errorMessage], $this->errorCode];
    }

    public function validateResolved()
    {
        $this->init();

        $this->prepareForValidation();

        $this->checkAuthorization();

        $this->checkValidation();
    }

    protected function checkAuthorization()
    {
        if (!$this->passesAuthorization()) {
            $this->failedAuthorization();
        }
    }

    protected function checkValidation()
    {
        if (!($instance = $this->getValidatorInstance())->passes()) {
            $this->failedValidation($instance);
        }
    }

    protected function init(): void
    {
        //
    }

    public function getResponseMessage(): array
    {
        return ['message' => $this->getMessage()];
    }

    protected function getMessage(): string
    {
        return 'Data successfully persisted';
    }
}
