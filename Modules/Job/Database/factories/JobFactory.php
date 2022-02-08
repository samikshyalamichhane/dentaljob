<?php

namespace Modules\Job\Database\Factories;

use Modules\Job\Entities\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employer_id' => $this->faker->numberBetween(1, 10),
            'jobcategory_id' => $this->faker->numberBetween(1, 10),
            'employer_name' => $this->faker->name,
            'location' => $this->faker->city,
            'job_title' => $this->faker->name,
            'salary' => $this->faker->numberBetween(10000, 30000),
            'job_type' => $this->faker->randomElement(['part-time', 'full-time']),
            'working_hours' => $this->faker->numberBetween(1, 7),
            'part_time_working_hours' => $this->faker->numberBetween(1, 4),
            'published_date' => now(),
            'deadline_date' => now(),
        ];
    }
}