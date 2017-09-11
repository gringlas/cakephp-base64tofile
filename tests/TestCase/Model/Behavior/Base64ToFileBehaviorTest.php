<?php
namespace Base64ToFile\Test\TestCase\Model\Behavior;

use Base64ToFile\Model\Behavior\Base64ToFileBehavior;
use Cake\TestSuite\TestCase;

/**
 * Base64ToFile\Model\Behavior\Base64ToFileBehavior Test Case
 */
class Base64ToFileBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Base64ToFile\Model\Behavior\Base64ToFileBehavior
     */
    public $Base64ToFile;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Base64ToFile = new Base64ToFileBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Base64ToFile);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
