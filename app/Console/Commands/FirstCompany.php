<?php

namespace App\Console\Commands;

use App\Models\EventCompany;
use App\Models\User;
use Illuminate\Console\Command;

class FirstCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:first-company {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the first company then creates the first user for that company';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if(EventCompany::all()->count() > 0){
            $this->error("There is already a registered company");
            return 1;
        }
        //
        $name = $this->argument('name');
        $desc = $this->ask("Give a short company description");
        $phone = $this->ask("Company phone number?");
        $email = $this->ask("What the company email?");


        EventCompany::create([
            "name" => $name,
            "description" => $desc,
            "phone" => $phone,
            "email" => $email
        ]);

        $this->info("Company created");

        $this->info("Creating admin user");

        $this->call("make:filament-user");

        // TODO: Assign created company id to admin user.

        return 0;
    }
}
