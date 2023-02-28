<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdvertisesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdvertisesTable Test Case
 */
class AdvertisesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AdvertisesTable
     */
    protected $Advertises;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Advertises',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Advertises') ? [] : ['className' => AdvertisesTable::class];
        $this->Advertises = $this->getTableLocator()->get('Advertises', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Advertises);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AdvertisesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
