<?php
namespace Darumaotoshi\Test\TestCase\Model\Behavior;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Darumaotoshi\Model\Behavior\TrashBehavior;

class DarumaotoshiBehaviorTest extends TestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Darumaotoshi.categories',
        'plugin.Darumaotoshi.comments',
        'plugin.Darumaotoshi.posts',
        'plugin.Darumaotoshi.posts_tags',
        'plugin.Darumaotoshi.tags',
        'plugin.Darumaotoshi.trash',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Categories = TableRegistry::get('Darumaotoshi.Categories', ['table' => 'categories']);
        $this->Categories->hasMany('Posts', [
            'className' => 'Darumaotoshi.Posts',
            'foreignKey' => 'category_id',
        ]);
        $this->Comments = TableRegistry::get('Darumaotoshi.Comments', ['table' => 'comments']);
        $this->Comments->belongsTo('Posts', [
            'className' => 'Darumaotoshi.Posts',
            'foreignKey' => 'post_id',
        ]);
        $this->Posts = TableRegistry::get('Darumaotoshi.Posts', ['table' => 'posts']);
        $this->Posts->belongsTo('Categories', [
            'className' => 'Darumaotoshi.Categories',
            'foreignKey' => 'category_id'
        ]);
        $this->Posts->hasMany('Comments', [
            'className' => 'Darumaotoshi.Comments',
            'foreignKey' => 'post_id',
        ]);
        $this->Posts->belongsToMany('Tags', [
            'className' => 'Darumaotoshi.Posts',
            'joinTable' => 'posts_tags',
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'tag_id',
        ]);
        $this->Tags = TableRegistry::get('Darumaotoshi.Tags', ['table' => 'tags']);
        $this->Tags->belongsToMany('Posts', [
            'className' => 'Darumaotoshi.Tags',
            'joinTable' => 'posts_tags',
            'foreignKey' => 'tag_id',
            'targetForeignKey' => 'post_id',
        ]);

        $this->Trash = TableRegistry::get('Darumaotoshi.Trash', ['table' => 'trash']);

        $this->Categories->addBehavior('Darumaotoshi.Darumaotoshi');
        $this->Posts->addBehavior('Darumaotoshi.Darumaotoshi');
        $this->Comments->addBehavior('Darumaotoshi.Darumaotoshi');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        TableRegistry::clear();
        unset(
            $this->Categories,
            $this->Comments,
            $this->Posts,
            $this->Tags,
            $this->Trash
        );
    }

    /**
     * testDelete
     *
     */
    public function testDelete(){
        $this->assertCount(3, $this->Posts->find('all')->toArray());
        $post = $this->Posts->get(1);
        $result = $this->Posts->delete($post);
        $this->assertTrue($result);        
        $this->assertCount(2, $this->Posts->find('all')->toArray());
        $this->assertCount(1, $this->Trash->find('all')->toArray());
    }

    /**
     * testCascadeDelete
     *
     */
    public function testCascadeDelete(){
        $this->Categories->hasMany('Posts', [
            'className' => 'Darumaotoshi.Posts',
            'foreignKey' => 'category_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->Posts->hasMany('Comments', [
            'className' => 'Darumaotoshi.Comments',
            'foreignKey' => 'post_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $category = $this->Categories->get(2);
        $result = $this->Categories->delete($category);
        $this->assertTrue($result);        
        $this->assertCount(3, $this->Trash->find('all')->toArray());
    }
}
