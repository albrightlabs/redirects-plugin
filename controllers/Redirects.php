<?php namespace Albrightlabs\Redirects\Controllers;

use BackendMenu;
use System\Classes\SettingsManager;
use Backend\Classes\Controller;

/**
 * Redirects Backend Controller
 */
class Redirects extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\ImportExportController::class
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var string importExportConfig file
     */
    public $importExportConfig = 'config_import_export.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['albrightlabs.redirects.manage_redirects',];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Albrightlabs.Redirects', 'redirects');
    }
}
