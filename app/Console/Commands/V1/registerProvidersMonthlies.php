<?php

namespace Convenia\Console\Commands\V1;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class registerProvidersMonthlies
 * @package Convenia\Console\Commands\V1
 */
class registerProvidersMonthlies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'V1.Providers:Monthlies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'register Monthlies of providers on database';

    /**
     * Created by Weslley Ribeiro.
     * @var
     */
    protected $_progressBar;
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
        try {
            $providers = DB::table('providers')->get()->toArray();

            $this->_progressBar = $this->output->createProgressBar(count($providers));
            $this->_progressBar->setFormat('verbose');
            $this->_progressBar->setMaxSteps(count($providers));
            $this->_progressBar->setEmptyBarCharacter(' ');

            foreach($providers as $provider){
                DB::table('providers_monthlies')
                    ->insert(
                        [
                            'monthly'       => $provider->monthly,
                            'providers_id'  => $provider->id,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s'),
                        ]
                    );
                //avançando barra de status
                $this->_progressBar->advance();

            }

            //finalizando process bar
            $this->_progressBar->finish();


        }catch (\Exception $ex){
            $this->error($ex->getMessage());
        }finally{
            //sempre executara
            $this->alert("Fim do processo :)");
        }
    }
}
