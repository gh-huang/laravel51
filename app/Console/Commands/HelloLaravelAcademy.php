<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HelloLaravelAcademy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel:academy {name=Laravel5.1} {--mark=!}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $name = $this->argument('name');
        $mark = $this->option('mark');
        $string = 'Hello ' . $name;
        if ($mark) {
            $string .= $mark;
        }
        echo $string . "\n";
        // $name = $this->ask('What do you want to say Hello?');
        // echo "Hello " . $name . "\n";
        // if ($this->confirm('Do you want to continue?[y|n]')) {
        //     $this->info('Continue');
        // } else {
        //     $this->error('Interput');
        // }
        // $name = $this->anticipate('What is your name?', ['Laravel', 'World']);
        // $this->info($name);
        // $name = $this->choice('What is your name?', ['Laravel', 'World']);
        // $this->info($name);
        // $this->info('Successful');
        // $this->error('Something Error');
        // $this->question('What do you want to do');
        // $this->comment('Just Comment it!');
        // $headers = ['Name', 'Email'];
        // $users = \App\Models\User::all(['name', 'email'])->toArray();
        // $this->table($headers, $users);
        // $this->output->progressStart(10);
        // for ($i = 0; $i < 10; $i++) { 
        //     sleep(1);
        //     $this->output->progressAdvance();
        // }
        // $this->output->progressFinish();
    }
}
