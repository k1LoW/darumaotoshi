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

    /**
     * __construct
     *
     * @param \Cake\ORM\Table $table table
     * @param array $config config
     */
    public function __construct(Table $table, array $config = [])
    {
        parent::__construct($table, $config);
        $this->TrashTable = TableRegistry::get('Darumaotoshi.Trash');
    }

    /**
     * implementedEvents
     *
     * @return array
     */
    public function implementedEvents()
    {
        return [
            'Model.beforeDelete' => 'beforeDelete',
        ];
    }

    /**
     * beforeDelete
     *
     * @param \Cake\Event\Event $event event
     * @param \Cake\Datasource\EntityInterface $entity entity
     * @param \ArrayObject $options options
     * @return bool
     */
    public function beforeDelete(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if (!$this->slide($entity)) {
            throw new RuntimeException();
        }

        return true;
    }

    /**
     * restore
     *
     * @param mixed $id primaryKey
     * @return bool
     */
    public function restore($id)
    {
        $table = $this->_table;
        $trashed = $this->TrashTable->find()
                 ->where([
                     'table_id' => $id,
                     'table_name' => $table->table(),
                 ])
                 ->first();
        if (empty($trashed)) {
            throw new RuntimeException();
        }
        $entity = $table->newEntity(
            json_decode($trashed->data, true)
        );
        $result = $table->save($entity, ['validate' => false, 'checkRules' => false]);
        if (!$result) {
            return false;
        }

        return $this->TrashTable->delete($trashed);
    }

    /**
     * cascadingRestore
     *
     * @param mixed $id primaryKey
     * @return bool
     */
    public function cascadingRestore($id)
    {
        $table = $this->_table;
        $result = $this->restore($id);

        foreach ($table->associations() as $association) {
            if (!$this->shouldCascade($association, $table)) {
                continue;
            }
            $trashed = $this->TrashTable->find()
                     ->where([
                         'source' => $association->target()->registryAlias(),
                         'table_name' => $association->table(),
                     ])
                     ->andWhere(function ($exp, $q) use ($id, $association) {
                         $like = '"' . $association->foreignKey() . '":' . $id . ',';

                         return $exp->like('data', '%' . $like . '%');
                     })
                     ->all();
            foreach ($trashed as $t) {
                if (!$association->target()->cascadingRestore($t->table_id)) {
                    return false;
                }
            }
        }

        return $result;
    }

    /**
     * slide
     *
     * @param Cake\Datasource\EntityInterface $entity entity
     * @return bool
     */
    protected function slide(EntityInterface $entity)
    {
        $table = $this->_table;
        foreach ($table->associations() as $association) {
            if ($this->shouldCascade($association, $table)) {
                $association->cascadeDelete($entity, ['_primary' => false]);
            }
        }
        $trash = $this->TrashTable->newEntity([
            'source' => $entity->source(),
            'table_id' => $entity->{$table->primaryKey()},
            'table_name' => $table->table(),
        ]);

        $data = [];
        $columns = $table->schema()->columns();
        foreach ($columns as $col) {
            $data[$col] = $entity->{$col};
        }
        $trash->set('data', json_encode($data));

        $result = $this->TrashTable->save($trash);

        return $result;
    }

    /**
     * see https://github.com/UseMuffin/Trash/blob/master/src/Model/Behavior/TrashBehavior.php#L323
     *
     * @param \Association $association association
     * @param \Cake\ORM\Table $table table
     * @return bool
     */
    protected function shouldCascade(Association $association, Table $table)
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
