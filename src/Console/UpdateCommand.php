<?php
namespace Ogilo\Faqs\Console;

use Illuminate\Console\Command;

use Ogilo\Faqs\Models\Package;

class UpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tp:update {--r|reset : Choose to rewrite slugs including existing ones}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tour Package post update command.';

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
        $this->call('migrate', ['--step']);
        $packages = Package::all();
        $this->comment('Updating slug and sanitizing price field');
        $bar = $this->output->createProgressBar(count($packages));
        foreach ($packages as $key => $package) {
            if ($this->option('reset')) {
                $package->slug = null;
            }

        	$package->slug = $package->slug ? $package->slug :str_slug_alt($package->title);

            $package->price = floatval($package->price);

            $package->save();
            $bar->advance();
        }
        $bar->finish();
        $this->comment('Done!');
    }
}
