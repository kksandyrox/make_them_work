<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PotholeVerificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PotholeVerificationsTable Test Case
 */
class PotholeVerificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PotholeVerificationsTable
     */
    public $PotholeVerifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pothole_verifications',
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
        $config = TableRegistry::getTableLocator()->exists('PotholeVerifications') ? [] : ['className' => PotholeVerificationsTable::class];
        $this->PotholeVerifications = TableRegistry::getTableLocator()->get('PotholeVerifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PotholeVerifications);

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
