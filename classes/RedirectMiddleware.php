<?php namespace Albrightlabs\Redirects\Classes;

use Request;
use Closure;
use Redirect;
use Albrightlabs\Redirects\Models\Redirect as RedirectModel;

/*******************************************************************************
 *******************************************************************************
 *
 * ██████╗ ███████╗ █████╗ ██████╗ ███╗   ███╗███████╗
 * ██╔══██╗██╔════╝██╔══██╗██╔══██╗████╗ ████║██╔════╝
 * ██████╔╝█████╗  ███████║██║  ██║██╔████╔██║█████╗
 * ██╔══██╗██╔══╝  ██╔══██║██║  ██║██║╚██╔╝██║██╔══╝
 * ██║  ██║███████╗██║  ██║██████╔╝██║ ╚═╝ ██║███████╗
 * ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝ ╚═╝     ╚═╝╚══════╝
 *
 * This handles redirects stored in the database. A request comes in,
 * the middleware looks to see if there is a redirect saved in the database
 * for the current request URL and if so it'll redirect to the provided URL.
 *
 *******************************************************************************
 ******************************************************************************/

class RedirectMiddleware
{

    /**
     * Handle an incoming request.
     *
     * Redirect to a new URL or do nothing.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // the current request URL
        $requestUrl = Request::path();

        // add a forward slash to the start of URL if doesn't exist
        if (substr($requestUrl, 0, 1) !== '/') {
            $requestUrl = '/'.$requestUrl;
        }

        // if there is a redirect in the database, return it
        if($redirect = RedirectModel::where('url_from', $requestUrl)->first()){
            return Redirect::to($redirect->url_to);
        }

        // allow the request to continue if nothing to redirect
        return $next($request);
    }

}
