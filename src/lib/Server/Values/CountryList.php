<?php

/**
 * File containing the CountryList class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\EzPlatformRest\Server\Values;

use EzSystems\EzPlatformRest\Value as RestValue;

/**
 * Country list view model.
 */
class CountryList extends RestValue
{
    /**
     * @var \eZ\Publish\API\Repository\Values\ContentType\Countries[]
     */
    public $countries;

    /**
     * Construct.
     */
    public function __construct(array $countries)
    {
        $this->countries = $countries;
    }
}
