<?php namespace Corals\Settings\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Lang;

class ModuleManager extends Command
{
    /*
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'corals:modules {--action= : available options (update) } {--type= : available options (core|module|payment|theme)} {--module_name= : theme or plugin name, pass all for all} {--skip_download= : just execute update patches} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Corals Module Manager';

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
     * @var string $action
     */
    private $action;

    /**
     * @var string $name
     */
    private $module_name;

    /**
     * @var string $types
     */
    private $type;


    /**
     * @var string $types
     */
    private $skip_download;


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        if ($this->confirm('Its highly recommend to backup application and database before, are you sure you want to proceed ?')) {


            $this->action = $this->option('action');
            $this->type = $this->option('type');
            $this->module_name = $this->option('module_name');
            $this->skip_download = $this->option('skip_download');


            if (!$this->action) {
                $this->error("Please specify action: update|enable|disable");
                return;
            }

            if (!$this->type) {
                $this->error("Please specify type: core|module|payment|theme");
                return;
            }

            if (!$this->module_name) {
                $this->error("Please specify object name using --module_name= , use 'all' for all ");
                return;
            }

            if ($this->action == "update") {
                $this->update();
            }

        }
    }

    public function update()
    {
        if (in_array($this->type, ['core', 'module', 'payment'])) {
            $modules = \Modules::getModulesSettings();
            $installed_modules = $modules->map(function ($item) {
                return ['version' => $item->version, 'code' => $item->code, 'license_key' => $item->installed_version];
            });
            $remote_updates = [];
            if (!$this->skip_download) {
                $remote_updates = \Modules::checkForUpdates(['check-for-updates' => true], $installed_modules, 'modules_remote_updates');
            }

            if ($this->module_name != "all") {
                $module = \Modules::getModulesSettings($this->module_name);
                if ($module->installed) {
                    if ($module->installed) {

                        if (!$this->skip_download) {
                            if (array_key_exists($module->code, $remote_updates)) {
                                $this->info("Downloading Module: " . $module->name);
                                \Modules::downloadRemote($module->code);
                            }
                        }
                        $this->info("Updating Module: " . $module->name);
                        \Modules::update($module->code);
                    } else {
                        $this->info("Module: " . $module->name . " is not installed");

                    }
                }

            } else {

                foreach ($modules as $module) {
                    if ($module->installed) {
                        if ($module->type == $this->type) {
                            try {
                                if (!$this->skip_download) {
                                    if (array_key_exists($module->code, $remote_updates)) {
                                        $this->info("Downloading Module: " . $module->name);
                                        \Modules::downloadRemote($module->code);
                                    }

                                }
                                $this->info("Updating Module: " . $module->name);
                                \Modules::update($module->code);

                            } catch (\Exception $exception) {
                                $this->error($exception->getMessage());
                            }
                        }
                    }

                }
            }

            $this->info("Don't forget to run composer update after module(s) download");
        } elseif ($this->type == "theme") {

            $themes = collect(\Theme::all());
            $installed_themes = [];

            foreach ($themes as $theme) {
                $installed_themes[] = ['version' => $theme->version, 'code' => $theme->name, 'license_key' => null];
            }

            $tempPath = \Theme::theme_packages_path('tmp');
            \Theme::createTempFolder();
            $remote_updates = \Modules::checkForUpdates(['check-for-updates' => true], $installed_themes, 'themes_remote_updates');
            if ($this->module_name != "all") {
                if (array_key_exists($this->module_name, $remote_updates)) {
                    $this->info("Updating Theme: " . $this->module_name);

                    \Modules::download($this->module_name, null, $tempPath);
                    $filename = $this->module_name . '.zip';
                    \Theme::installTheme($filename, true);
                } else {
                    $this->info("Theme: $this->module_name is up to date");
                }

            } else {

                foreach ($themes as $theme) {
                    try {
                        if (array_key_exists($theme->name, $remote_updates)) {
                            $this->info("Updating Theme: " . $theme->name);
                            \Modules::download($theme->name, null, $tempPath);
                            $filename = $theme->name . '.zip';
                            \Theme::installTheme($filename, true);
                        } else {
                            $this->info("Theme: $theme->name is up to date");
                        }

                    } catch (\Exception $exception) {
                        $this->error($exception->getMessage());
                    }

                }
            }
        } else {
            $this->error("Invalid module type: { $this->type } supported: core|module|payment|theme ");
            return;
        }

    }


}
