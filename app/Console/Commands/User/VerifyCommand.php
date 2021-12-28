<?php

namespace App\Console\Commands\User;

use App\UseCases\Auth\RegisterService;
use App\User;
use Illuminate\Console\Command;

class VerifyCommand extends Command
{
    protected $signature = 'user:verify {email}';

    protected $description = 'Set user status to active from wait in db';
    protected $service;

    public function __construct(RegisterService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function handle()
    {
        $email = $this->argument('email');

        if (!$user = User::query()->where('email', $email)->first()) {
            $this->line("<fg=red>Can't find email</>");
            return false;
        }

        try {
            $this->service->verify($user->id);
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
            return false;
        }

        $this->info('User was verified');
        return true;
    }
}
