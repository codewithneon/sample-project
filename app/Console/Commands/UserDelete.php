<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To Run This Command User Will be drop every day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
      $user=User::query()->first();
      $user->delete();
      $this->info("User Delete Successful");
    }
}
