<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use Carbon\Carbon;

class CloseAuctions extends Command
{
    protected $signature = 'auctions:close';
    protected $description = 'Close auctions whose ends_at has passed';

    public function handle()
    {
        $now = Carbon::now();
        $items = Item::where('status', 'open')
            ->whereNotNull('ends_at')
            ->where('ends_at', '<=', $now)
            ->get();

        foreach ($items as $item) {
            $this->info("Closing item {$item->id} ({$item->name})");
            $item->close();
        }

        $this->info('Done.');
        return 0;
    }
}
