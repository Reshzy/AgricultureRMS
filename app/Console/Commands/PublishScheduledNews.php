<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Illuminate\Support\Carbon;

class PublishScheduledNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:publish-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish scheduled news items that have reached their publish time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        
        // Debug: Show current time
        $this->line("Checking for scheduled news at: {$now->toDateTimeString()}");
        
        // Find all scheduled news items where published_at is in the past
        $scheduledNews = News::where('status', 'scheduled')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', $now)
            ->get();

        // Debug: Show what we found
        $totalScheduled = News::where('status', 'scheduled')->whereNotNull('published_at')->count();
        if ($totalScheduled > 0) {
            $this->line("Found {$totalScheduled} scheduled news item(s) total.");
            $upcoming = News::where('status', 'scheduled')
                ->whereNotNull('published_at')
                ->where('published_at', '>', $now)
                ->get();
            if ($upcoming->count() > 0) {
                $this->line("  - {$upcoming->count()} item(s) scheduled for future publication:");
                foreach ($upcoming as $item) {
                    $this->line("    * ID {$item->id}: '{$item->title}' - scheduled for {$item->published_at->toDateTimeString()}");
                }
            }
        }

        if ($scheduledNews->isEmpty()) {
            $this->info('No scheduled news items to publish at this time.');
            return Command::SUCCESS;
        }

        $count = 0;
        foreach ($scheduledNews as $news) {
            $news->status = 'published';
            $news->save();
            $count++;
            $this->info("✓ Published: {$news->title} (ID: {$news->id})");
        }

        $this->info("Successfully published {$count} news item(s).");
        return Command::SUCCESS;
    }
}

