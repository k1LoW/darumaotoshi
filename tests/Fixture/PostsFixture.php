<?php
namespace Darumaotoshi\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PostsFixture
 *
 */
class PostsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'category_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'title' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'body' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
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
            'category_id' => 1,
            'title' => 'About CakePHP',
            'body' => 'CakePHP is awesome!',
            'created' => '2016-07-22 11:37:21',
            'modified' => '2016-07-22 11:37:23'
        ],
        [
            'id' => 2,
            'category_id' => 1,
            'title' => 'About mod_php',
            'body' => 'mod_php is awesome!',
            'created' => '2016-07-22 11:38:46',
            'modified' => '2016-07-22 11:38:48'
        ],
        [
            'id' => 3,
            'category_id' => 2,
            'title' => 'About Cake',
            'body' => 'Cake Cake',
            'created' => '2016-07-22 11:46:20',
            'modified' => '2016-07-22 11:46:22'
        ],
    ];
}
