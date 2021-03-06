<?php

/**
 * File containing the SeeOther class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\EzPlatformRest\Server\Values;

use EzSystems\EzPlatformRest\Value as RestValue;

class SeeOther extends RestValue
{
    public function __construct($redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }
}
