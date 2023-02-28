<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmailListFixture
 */
class EmailListFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'email_list';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'email' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-01-15 18:37:19',
                'modified' => '2023-01-15 18:37:19',
            ],
        ];
        parent::init();
    }
}
