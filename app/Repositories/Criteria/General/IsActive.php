<?php
/**
 * File Description
 *
 * Some comprehensive Description of the files contents
 *
 * @author Your Name <Antonis.Lilis@interactivedata.com>
 * @user AntonyLilis
 * @version $Author:$ $Id:$ $Revision:$ $Date:$
 * @copyright 2017 Interactive Data Managed Solutions AG
 * @since 16/6/2017
 */

namespace App\Repositories\Criteria\General;

use App\Repositories\Criteria\Criteria;
use App\Repositories\RepositoryInterface;

class IsActive extends Criteria
{

    public function apply($model, RepositoryInterface $repository, $data = null)
    {
        $query = $model->where('is_active', true);
        return $query;
    }
}