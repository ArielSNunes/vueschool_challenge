<?php

namespace App\Console\Commands;

use App\Enums\TimezoneEnum;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UpdateUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will update user data and timezones';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $rowsPerChunk = 10;
        $timezones = TimezoneEnum::getValues();

        DB::transaction(function () use ($rowsPerChunk, $timezones) {
            User::chunk($rowsPerChunk, function (Collection $users) use ($timezones) {
                $users->each(function (User $user) use ($timezones) {
                    $newFirstName = fake()->firstName();
                    $newTimeZone = $timezones[array_rand($timezones)];

                    $fullName = Str::of($user->name)->explode(' ');
                    $fullName->put(0, $newFirstName);
                    $newName = $fullName->join(' ');

                    $user->update(['name' => $newName, 'time_zone' => $newTimeZone]);
                    Log::info("[{$user->id}] firstname: {$newFirstName}, timezone: '{$user->time_zone->value}'");
                });
            });
        });
    }
}
