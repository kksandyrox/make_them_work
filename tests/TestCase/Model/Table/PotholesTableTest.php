<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PotholesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PotholesTable Test Case
 */
class PotholesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PotholesTable
     */
    public $Potholes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.potholes',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Potholes') ? [] : ['className' => PotholesTable::class];
        $this->Potholes = TableRegistry::getTableLocator()->get('Potholes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Potholes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
