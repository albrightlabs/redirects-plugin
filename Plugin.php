<?php namespace Albrightlabs\Redirects;

use Backend;
use Tsy\Franchises\Models\Fo;
use Tsy\Franchises\Models\Foblog;
use Tsy\Franchises\Models\LawnCareGuides;
use Tsy\Franchises\Models\LawnCareTopics;
use Tsy\Franchises\Models\PestControlGuides;
use Tsy\Franchises\Models\PestControlTopics;
use Tsy\Franchises\Models\TreeCareGuides;
use Tsy\Franchises\Models\TreeCareTopics;
use Tsy\Franchises\Models\PpcLandingPages;
use Tsy\Franchises\Models\Regions;
use Tsy\Franchises\Models\Franchise;
use Tsy\Franchises\Models\Services;
use Tsy\Franchises\Models\ServicesCategories;
use Albrightlabs\Policies\Models\Policy;
use Albrightlabs\Glossary\Models\Term;
use RainLab\Blog\Models\Post;
use RainLab\Blog\Models\Category;
use System\Classes\PluginBase;
use ValidationException;

/**
 * Redirects Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Redirects',
            'description' => 'Manages redirects and historical slugs for SG.',
            'author'      => 'Albright Labs LLC',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {
        // Register the redirect middleware
        \Cms\Classes\CmsController::extend(function($controller) {
            $controller->middleware(\Albrightlabs\Redirects\Classes\RedirectMiddleware::class);
        });
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'albrightlabs.redirects.manage_redirects' => [
                'tab' => 'Redirects',
                'label' => 'Manage system-wide redirects'
            ],
        ];
    }

    /**
     * Registers back-end settings for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'redirects' => [
                'label' => 'Redirects',
                'description' => 'Manage and manually create front-end redirects.',
                'category' => 'Redirects',
                'icon' => 'icon-exchange',
                'url' => Backend::url('albrightlabs/redirects/redirects'),
                'order' => 500,
                'keywords' => 'redirects urls'
            ]
        ];
    }
}
