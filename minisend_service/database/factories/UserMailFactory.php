<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserMail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sender_id = User::all()->random(1)->first()->id;

        $status = ['POSTED', 'SENT', 'FAILED'][rand(0,2)];

        return [
            'sender_id' => $sender_id,
            'to' => $this->faker->email,
            'subject' => $this->faker->sentence,
            'body' => rand(0, 1) === 1 ? $this->faker->paragraphs(rand(1, 6), true) : $this->faker->randomHtml(),
            'status' => $status,
            'sent_at' => $status === 'SENT' ? Carbon::now() : null
        ];
    }
}
