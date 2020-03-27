<?php

namespace App\Console\Commands;

use App\Club;
use App\ManagerContract;
use App\Person;
use App\PlayerContract;
use App\Transaction;
use Illuminate\Console\Command;

class PayWages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wages:pay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Time to pay wages!';

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
     * @return mixed
     */
    public function handle()
    {
        $this->payManagers();
        $this->payPlayers();
    }

    private function payManagers() {
        $contracts = ManagerContract::whereDate('from', '<', now())->whereDate('until', '>', now())
            ->whereDate('updated_at', '<', now()->subWeek())
            ->where('status', 'ongoing')
            ->orderBy('updated_at')
            ->take(1000)
            ->get();

        foreach ($contracts as $contract) {
            $contract->receiveSalary();
        }
    }

    private function payPlayers() {
        $contracts = PlayerContract::whereDate('from', '<', now())->whereDate('until', '>', now())
            ->whereDate('updated_at', '<', now()->subWeek())
            ->orderBy('updated_at')
            ->take(1000)
            ->get();

        foreach ($contracts as $contract) {
            $contract->receiveSalary();
        }
    }
}
