<?php

namespace Database\Factories;

use Illuminate\Foundation\Testing\WithFaker;

/**
 * @template TModel
 */
abstract class NonModelFactory
{
    use WithFaker;

    private int $count = 1;

    /**
     * @var array<callable>
     */
    protected array $states = [];

    private function __construct()
    {
    }

    public static function new(): static
    {
        $instance = new static();
        $instance->setUpFaker();
        return $instance;
    }

    /**
     * @return array<string, mixed>
     */
    abstract public function definition(): array;

    /**
     * @return class-string<TModel>
     */
    abstract public function model(): string;

    /**
     * @return array<TModel>|TModel
     */
    public function create(): array|object
    {
        /** @var array<TModel> $instances*/
        $instances = [];

        for ($i = 0; $i < $this->count; $i++){

            $attributes = $this->definition();

            foreach ($this->states as $state){
                $attributes = [...$attributes , ...($state($attributes))];
            }

            $instances[] = new ($this->model())(...$attributes);
        }
        return count($instances) === 1 ? $instances[0] : $instances;
    }


    public function count(int $count): static
    {
        $this->count = $count;
        return $this;
    }

}
