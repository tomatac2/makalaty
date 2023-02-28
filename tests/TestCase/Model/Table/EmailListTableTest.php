<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailListTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailListTable Test Case
 */
class EmailListTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailListTable
     */
    protected $EmailList;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.EmailList',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('EmailList') ? [] : ['className' => EmailListTable::class];
        $this->EmailList = $this->getTableLocator()->get('EmailList', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->EmailList);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EmailListTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
