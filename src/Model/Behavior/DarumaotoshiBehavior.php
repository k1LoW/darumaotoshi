<?php
namespace Darumaotoshi\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Association;
use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use RuntimeException;

class DarumaotoshiBehavior extends Behavior
{
    public function __construct(Table $table, array $config = [])
    {
        parent::__construct($table, $config);
        $this->TrashTable = TableRegistry::get('Darumaotoshi.Trash');
    }

    public function implementedEvents()
    {
        return [
            'Model.beforeDelete' => 'beforeDelete',
        ];
    }

    public function beforeDelete(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if (!$this->slide($entity)) {
            throw new RuntimeException();
        }
        return true;
    }

    /**
     * slide
     *
     */
    public function slide(EntityInterface $entity){
        $source = $entity->source();
        $table = TableRegistry::get($source);
        $tableName = $table->table();
        foreach ($this->_table->associations() as $association) {
            if ($this->shouldBeCascadeDelete($association, $this->_table)) {
                $association->cascadeDelete($entity, ['_primary' => false]);
            }
        }

        $trash = $this->TrashTable->newEntity([
            'source' => $source,
            'table_name' => $tableName,
        ]);

        $data = [];
        $columns = $table->schema()->columns();
        foreach ($columns as $col) {
            $data[$col] = $entity->{$col};
        }
        $trash->set('data',json_encode($data));

        $result = $this->TrashTable->save($trash);
        return $result;
    }

    /**
     * see https://github.com/UseMuffin/Trash/blob/master/src/Model/Behavior/TrashBehavior.php#L323
     */
    private function shouldBeCascadeDelete(Association $association, Table $table)
    {
        if ($association->target()->hasBehavior('Darumaotoshi')
            && $association->isOwningSide($table)
            && $association->dependent()
            && $association->cascadeCallbacks()) {
            return true;
        }
        return false;
    }
}
