<?php

/**
 * File containing a test class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\EzPlatformRest\Tests\Server\Output\ValueObjectVisitor;

use EzSystems\EzPlatformRest\Tests\Output\ValueObjectVisitorBaseTest;
use EzSystems\EzPlatformRest\Server\Output\ValueObjectVisitor;
use eZ\Publish\API\Repository\Values\Content;

class SectionTest extends ValueObjectVisitorBaseTest
{
    /**
     * Test the Section visitor.
     *
     * @return string
     */
    public function testVisit()
    {
        $visitor = $this->getVisitor();
        $generator = $this->getGenerator();

        $generator->startDocument(null);

        $section = new Content\Section(
            array(
                'id' => 23,
                'identifier' => 'some-section',
                'name' => 'Some Section',
            )
        );

        $this->addRouteExpectation(
            'ezpublish_rest_loadSection',
            array('sectionId' => $section->id),
            "/content/sections/{$section->id}"
        );

        $visitor->visit(
            $this->getVisitorMock(),
            $generator,
            $section
        );

        $result = $generator->endDocument(null);

        $this->assertNotNull($result);

        return $result;
    }

    /**
     * Test if result contains Section element.
     *
     * @param string $result
     *
     * @depends testVisit
     */
    public function testResultContainsSectionElement($result)
    {
        $this->assertXMLTag(
            array(
                'tag' => 'Section',
                'children' => array(
                    'less_than' => 4,
                    'greater_than' => 2,
                ),
            ),
            $result,
            'Invalid <Section> element.',
            false
        );
    }

    /**
     * Test if result contains Section element attributes.
     *
     * @param string $result
     *
     * @depends testVisit
     */
    public function testResultContainsSectionAttributes($result)
    {
        $this->assertXMLTag(
            array(
                'tag' => 'Section',
                'attributes' => array(
                    'media-type' => 'application/vnd.ez.api.Section+xml',
                    'href' => '/content/sections/23',
                ),
            ),
            $result,
            'Invalid <Section> attributes.',
            false
        );
    }

    /**
     * Test if result contains sectionId value element.
     *
     * @param string $result
     *
     * @depends testVisit
     */
    public function testResultContainsSectionIdValueElement($result)
    {
        $this->assertXMLTag(
            array(
                'tag' => 'sectionId',
                'content' => '23',
            ),
            $result,
            'Invalid or non-existing <Section> sectionId value element.',
            false
        );
    }

    /**
     * Test if result contains identifier value element.
     *
     * @param string $result
     *
     * @depends testVisit
     */
    public function testResultContainsIdentifierValueElement($result)
    {
        $this->assertXMLTag(
            array(
                'tag' => 'identifier',
                'content' => 'some-section',
            ),
            $result,
            'Invalid or non-existing <Section> identifier value element.',
            false
        );
    }

    /**
     * Test if result contains name value element.
     *
     * @param string $result
     *
     * @depends testVisit
     */
    public function testResultContainsNameValueElement($result)
    {
        $this->assertXMLTag(
            array(
                'tag' => 'name',
                'content' => 'Some Section',
            ),
            $result,
            'Invalid or non-existing <Section> name value element.',
            false
        );
    }

    /**
     * Get the Section visitor.
     *
     * @return \EzSystems\EzPlatformRest\Server\Output\ValueObjectVisitor\Section
     */
    protected function internalGetVisitor()
    {
        return new ValueObjectVisitor\Section();
    }
}
