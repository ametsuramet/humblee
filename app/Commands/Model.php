<?php
namespace App\Commands;
use Amet\Humblee\Bases\BaseConsole;
use Amet\Humblee\Bases\Mail;
class Model extends BaseConsole {
	
	protected $description = "Generate DB Model , type column:\n\tprimary_key\n\tstring\n\ttext\n\ttinytext\n\tmediumtext\n\tinteger\n\ttinyinteger\n\tsmallinteger\n\tmediuminteger\n\tbiginteger\n\tfloat\n\tdecimal\n\tdatetime\n\ttimestamp\n\ttime\n\tdate\n\tbinary\n\ttinybinary\n\tmediumbinary\n\tlongbinary\n\tboolean\n exp:\n php run  model --name=Role --column=name,description --type=string,text --length=100,200";


	protected function boot()
	{

	}

	protected function handle()
	{
		$base_path = realpath( __DIR__.'/../../' );
		global $config;
		$arg = $this->arguments;
		// print_r($arg);die();
		$name = ucfirst($arg['name']);
		$table = str_plural(snake_case($arg['name']));
		$model_migration = "Create".ucfirst($arg['name'])."Table";
		$template_file = $base_path.('/vendor/ametsuramet/humblee-framework/src/stubs/Model.stub');
		$database = $config['database']['db'][$config['app']['APP_ENV']]['database'];
		$migration_path = $base_path.('/migrations/'.$database);
		$output_file = $migration_path.'/'.date("Ymdhis")."_".$model_migration.".php";
		try {
		
			$column = isset($arg['column']) ? explode(",", $arg['column']) : [];
			$type = isset($arg['type']) ? explode(",", $arg['type']) : [];
			$length = isset($arg['length']) ? explode(",", $arg['length']) : [];
			if (isset($arg['length'])) {
				if ((count($column) !== count($type)) || (count($length) !== count($type))) {
					throw new \Exception("Options Invalid value");
				}
			} else {
				if ((count($column) !== count($type))) {
					throw new \Exception("Options Invalid value");
				}
			}
			$fh = fopen($template_file,'r+');
            $content = "";
            $line_number = 1;
            while(!feof($fh)) {
            	$line = fgets($fh);
                $line = str_replace("Model_name", $model_migration, $line);
                $line = str_replace("table_name", $table, $line);
                if ($line_number == 8) {
                	foreach ($column as $key => $col) {
                		$line .= "\t\t".'$users->column("'.$col.'", "'.$type[$key].'"';
                		if (count($length)) {
                			if ($type[$key] != "text") {
                				$line .= ', ["limit" => '.$length[$key].']';
                			}
                		}
                		$line .= ");".PHP_EOL;
                	}
                	
                }
                $content .= $line;
                $line_number++;
            }
            file_put_contents($output_file, $content);
			$this->info($output_file. " created");

		} catch (\Exception $e) {
			$this->alert($e->getMessage());
		}
	}

	private function getStubPath()
    {
        return __DIR__.'/../stubs';
    }
}