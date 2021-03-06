<?php

namespace AppBundle\Tests\Entity;

use AppBundle\DBAL\Types\ItemAreaTypeType;
use AppBundle\DBAL\Types\ItemStatusType;
use AppBundle\DBAL\Types\ItemTypeType;
use AppBundle\Entity\Category;
use AppBundle\Entity\Item;
use AppBundle\Entity\User;
use AppBundle\Entity\ItemRequest;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Item Entity Test
 *
 * @author Artem Genvald      <genvaldartem@gmail.com>
 * @author Yuri Svatok        <svatok13@gmail.com>
 * @author Andrew Prohorovych <prohorovychua@gmail.com>
 * @author Oleg Kachinsky     <logansoleg@gmail.com>
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Item entity
     */
    public function testEmptyItem()
    {
        $item = new Item();
        $this->assertNull($item->getId());
        $this->assertEquals('New Item', $item->__toString());
        $this->assertNull($item->getTitle());
        $this->assertNull($item->getLatitude());
        $this->assertNull($item->getLongitude());
        $this->assertNull($item->getType());
        $this->assertNull($item->getDescription());
        $this->assertNull($item->getArea());
        $this->assertNull($item->getAreaType());
        $this->assertEquals(ItemStatusType::ACTUAL, $item->getStatus());
        $this->assertTrue($item->isActive());
        $this->assertNull($item->getDate());
        $this->assertNull($item->getCreatedBy());
        $this->assertFalse($item->isModerated());
        $this->assertNull($item->getModeratedAt());
        $this->assertFalse($item->isDeleted());
        $this->assertNull($item->getActivatedAt());
        $this->assertNull($item->getDeletedAt());
    }

    /**
     * Test setter and getter for Category
     */
    public function testSetGetCategory()
    {
        $category = new Category();
        $item = (new Item())->setCategory($category);
        $this->assertEquals($category, $item->getCategory());
    }

    /**
     * Test setter and getter for Title
     */
    public function testSetGetTitle()
    {
        $title = 'Title';
        $item = (new Item())->setTitle($title);
        $this->assertEquals($title, $item->getTitle());
    }

    /**
     * Test setter and getter for Latitude
     */
    public function testSetGetLatitude()
    {
        $latitude = 55.555555555;
        $item = (new Item())->setLatitude($latitude);
        $this->assertEquals($latitude, $item->getLatitude());
    }

    /**
     * Test setter and getter for Longitude
     */
    public function testSetGetLongitude()
    {
        $longitude = 77.777777777;
        $item = (new Item())->setLongitude($longitude);
        $this->assertEquals($longitude, $item->getLongitude());
    }

    /**
     * Test setter and getter for Type
     */
    public function testSetGetType()
    {
        $type = ItemTypeType::LOST;
        $item = (new Item())->setType($type);
        $this->assertEquals($type, $item->getType());
    }

    /**
     * Test setter and getter for Description
     */
    public function testSetGetDescription()
    {
        $description = 'Description';
        $item = (new Item())->setDescription($description);
        $this->assertEquals($description, $item->getDescription());
    }

    /**
     * Test setter and getter for Area
     */
    public function testSetGetArea()
    {
        $area = [
            'a' => 1,
            'b' => 2,
        ];

        $item = (new Item())->setArea($area);
        $this->assertEquals($area, $item->getArea());
    }

    /**
     * Test setter and getter for AreaType
     */
    public function testSetGetAreaType()
    {
        $areaType = ItemAreaTypeType::MARKER;
        $item = (new Item())->setAreaType($areaType);
        $this->assertEquals($areaType, $item->getAreaType());
    }

    /**
     * Test setter and getter for Status
     */
    public function testSetGetStatus()
    {
        $status = ItemStatusType::ACTUAL;
        $item = (new Item())->setStatus($status);
        $this->assertEquals($status, $item->getStatus());
    }

    /**
     * Test setter and getter for Active
     */
    public function testSetGetActiveFalse()
    {
        $active = false;
        $item = (new Item())->setActive($active);
        $this->assertEquals($active, $item->isActive());
    }

    /**
     * Test setter and getter for Active
     */
    public function testSetGetActiveTrue()
    {
        $active = true;
        $item = (new Item())->setActive($active);
        $this->assertEquals($active, $item->isActive());
    }

    /**
     * Test setter and getter for Date
     */
    public function testSetGetDate()
    {
        $date = new \DateTime();
        $item = (new Item())->setDate($date);
        $this->assertEquals($date, $item->getDate());
    }

    /**
     * Test setter and getter for CreatedBy
     */
    public function testSetGetCreatedBy()
    {
        $createdBy = new User();
        $item = (new Item())->setCreatedBy($createdBy);
        $this->assertEquals($createdBy, $item->getCreatedBy());
    }

    /**
     * Test setter and getter for Moderated
     */
    public function testSetGetModerated()
    {
        $moderated = true;
        $item = (new Item())->setModerated($moderated);
        $this->assertEquals($moderated, $item->isModerated());
    }

    /**
     * Test setter and getter for ModeratedAt
     */
    public function testSetGetModeratedAt()
    {
        $moderatedAt = new \DateTime();
        $item = (new Item())->setModeratedAt($moderatedAt);
        $this->assertEquals($moderatedAt, $item->getModeratedAt());
    }

    /**
     * Test post moderate method
     */
    public function testPostModerate()
    {
        /* TODO: Test for post moderate method */
    }

    /**
     *  Test setter and getter for activated at method
     */
    public function testSetGetActivatedAt()
    {
        $time = new \DateTime();
        $item = (new Item())->setActivatedAt($time);
        $this->assertEquals($time, $item->getActivatedAt());
    }

    /**
     * Test setter and getter for deleted at method
     */
    public function testSetGetDeletedAt()
    {
        $time = new \DateTime();
        $item = (new Item())->setDeletedAt($time);
        $this->assertEquals($time, $item->getDeletedAt());
    }

    /**
     * Test setter and getter for deleted with param false
     */
    public function testSetIsDeletedFalse()
    {
        $deleted = false;
        $item = (new Item())->setDeleted($deleted);
        $this->assertEquals($deleted, $item->isDeleted());
    }

    /**
     * Test setter and getter for deleted with param true
     */
    public function testSetIsDeletedTrue()
    {
        $deleted = true;
        $item = (new Item())->setDeleted($deleted);
        $this->assertEquals($deleted, $item->isDeleted());
    }

    /**
     * Test setter and getter itemRequests
     */
    public function testSetGetItemRequests()
    {
        $arr        = [
            'log1' => new ItemRequest(),
            'log2' => new ItemRequest()
        ];
        $user = new User();
        $collection = new ArrayCollection($arr);
        $item       = ((new Item())->setCreatedBy($user)->setUserRequests($collection));
        $this->assertEquals($collection, $item->getUserRequests());
    }

    /**
     * Test add and remove for userRequests
     */
    public function testAddRemoveActionLog()
    {
        $item = new Item();
        $user = new User();
        $this->assertEquals(0, $item->getUserRequests()->count());
        $item->setCreatedBy($user)->addUserRequest(new ItemRequest());
        $this->assertEquals(1, $item->getUserRequests()->count());
        $userRequest = $item->getUserRequests()->first();
        $item->removeUserRequest($userRequest);
        $this->assertEquals(0, $item->getUserRequests()->count());
    }
}
