<?php namespace Albrightlabs\Redirects\Models;

use Albrightlabs\Redirects\Models\Redirect;

class RedirectImport extends \Backend\Models\ImportModel

{
    /**
     * @var array The rules to be applied to the data.
     */
    public $rules = [];

    public function importData($results, $sessionKey = null)
    {
        foreach ($results as $row => $data) {

            try {
                $redirect = new Redirect;
                $redirect->fill($data);
                $redirect->save();

                $this->logCreated();
            }
            catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }

        }
    }
}
