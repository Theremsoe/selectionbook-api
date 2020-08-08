<?php

namespace App\Providers\Components\JsonApiSpec\Http\Requests;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

abstract class ResourceFormRequest extends FormRequest
{
    /**
     * Define the JSON Api Specification wrapper.
     */
    protected string $jsonApiSpecWrapper = 'data.attributes';

    public function validated(): array
    {
        return Arr::get(parent::validated(), $this->jsonApiSpecWrapper, []);
    }

    /**
     * Iterate over the defined rules and wrapp keys in JSON Api Spec schema.
     */
    public function wrapRulesWithJsonApiSpec(): array
    {
        return collect($this->container->call([$this, 'rules']))
            ->keyBy(fn ($rules, $key): string => "{$this->jsonApiSpecWrapper}.{$key}")
            // Prepend the basic rule structure for reject payloads that not
            // satisfies de spec.
            ->prepend('bail|required|array', $this->jsonApiSpecWrapper)
            ->all()
        ;
    }

    protected function createDefaultValidator(ValidationFactory $factory): Validator
    {
        return $factory->make(
            $this->validationData(),
            $this->wrapRulesWithJsonApiSpec(),
            $this->messages(),
            $this->attributes()
        );
    }
}
