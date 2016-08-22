<?php
namespace Darumaotoshi\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PostsTagsFixture
 *
 */
class PostsTagsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'post_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tag_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'utf8_general_ci'
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
            'post_id' => 1,
            'tag_id' => 1,
            'created' => '2016-07-22 11:47:02',
            'modified' => '2016-07-22 11:47:04'
        ],
        [
            'id' => 2,
            'post_id' => 1,
            'tag_id' => 2,
            'created' => '2016-07-22 11:47:13',
            'modified' => '2016-07-22 11:47:15'
        ],
        [
            'id' => 3,
            'post_id' => 1,
            'tag_id' => 3,
            'created' => '2016-07-22 11:47:24',
            'modified' => '2016-07-22 11:47:26'
        ],
        [
            'id' => 4,
            'post_id' => 1,
            'tag_id' => 4,
            'created' => '2016-07-22 11:47:33',
            'modified' => '2016-07-22 11:47:35'
        ],
        [
            'id' => 5,
            'post_id' => 2,
            'tag_id' => 1,
            'created' => '2016-07-22 11:47:52',
            'modified' => '2016-07-22 11:47:55'
        ],
        [
            'id' => 6,
            'post_id' => 2,
            'tag_id' => 3,
            'created' => '2016-07-22 11:48:03',
            'modified' => '2016-07-22 11:48:05'
        ],
    ];
}
