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

        $company = EventCompany::create([
            "name" => $name,
            "description" => $desc,
            "phone" => $phone,
            "email" => $email
        ]);

        $this->info("Company created with ID: " . $company->id );

        $this->info("Creating admin user");

        $this->call("make:filament-user");

        $firstUser = User::all()->first();
        $firstUser->update([
           "company_id" => (int)$company->id
        ]);
        $firstUser->save();
        $firstUser = $firstUser->fresh();

        $this->info("Assigned user " . $firstUser->name . " to company ID: " . $firstUser->company_id);

        return 0;
    }
}
