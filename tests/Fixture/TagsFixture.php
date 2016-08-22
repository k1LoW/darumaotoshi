<?php
namespace Darumaotoshi\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TagsFixture
 *
 */
class TagsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'name' => 'PHP',
            'created' => '2016-07-22 11:35:28',
            'modified' => '2016-07-22 11:35:30'
        ],
        [
            'id' => 2,
            'name' => 'MySQL',
            'created' => '2016-07-22 11:35:40',
            'modified' => '2016-07-22 11:35:46'
        ],
        [
            'id' => 3,
            'name' => 'Apache',
            'created' => '2016-07-22 11:35:57',
            'modified' => '2016-07-22 11:35:59'
        ],
        [
            'id' => 4,
            'name' => 'Linux',
            'created' => '2016-07-22 11:36:11',
            'modified' => '2016-07-22 11:36:14'
        ],
    ];
}
