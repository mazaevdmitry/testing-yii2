<?php

use yii\db\Migration;

/**
 * Class m211112_100736_type_obj
 */
class m211112_100736_type_obj extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%obj_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
        ]);
        $this->insert('{{%obj_type}}', ['id' => 1, 'name' => 'Кран',]);
        $this->insert('{{%obj_type}}', ['id' => 2, 'name' => 'Машина',]);
        $this->insert('{{%obj_type}}', ['id' => 3, 'name' => 'Автобус',]);


        $this->createTable('{{%obj_type_properties}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->notNull(),
            'data_type' => $this->integer()->notNull()->defaultValue(1),
            'name' => $this->string(50)->notNull(),
        ]);
        $this->addForeignKey('fk_obj_type_properties', '{{%obj_type_properties}}', 'type_id', '{{%obj_type}}', 'id');
        $this->insert('{{%obj_type_properties}}', ['id' => 1, 'type_id' => 1,'name' => 'высота']);
        $this->insert('{{%obj_type_properties}}', ['id' => 2, 'type_id' => 1,'name' => 'грузоподъемность']);
        $this->insert('{{%obj_type_properties}}', ['id' => 3, 'type_id' => 1,'data_type' => 2, 'name' => 'модель']);
        $this->insert('{{%obj_type_properties}}', ['id' => 4, 'type_id' => 2,'name' => 'мощность']);
        $this->insert('{{%obj_type_properties}}', ['id' => 5, 'type_id' => 2,'data_type' => 3, 'name' => 'легковой']);
        $this->insert('{{%obj_type_properties}}', ['id' => 6, 'type_id' => 3,'data_type' => 2, 'name' => 'модель']);
        $this->insert('{{%obj_type_properties}}', ['id' => 7, 'type_id' => 3,'name' => 'пассажировместимость']);


        $this->createTable('{{%obj_list}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'type_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp() . ' default CURRENT_TIMESTAMP',
        ]);
        $this->addForeignKey('fk_obj_list_type', '{{%obj_list}}', 'type_id', '{{%obj_type}}', 'id');

        $this->insert('{{%obj_list}}', ['id' => 1, 'name' => 'Объект Кран_1', 'type_id' => 1]);
        $this->insert('{{%obj_list}}', ['id' => 2, 'name' => 'Объект Машина_1', 'type_id' => 2]);
        $this->insert('{{%obj_list}}', ['id' => 3, 'name' => 'Объект Автобус_1', 'type_id' => 3]);

        $this->insert('{{%obj_list}}', ['id' => 4, 'name' => 'Объект Кран_2', 'type_id' => 1]);
        $this->insert('{{%obj_list}}', ['id' => 5, 'name' => 'Объект Машина_2', 'type_id' => 2]);
        $this->insert('{{%obj_list}}', ['id' => 6, 'name' => 'Объект Автобус_2', 'type_id' => 3]);


        $this->createTable('{{%obj_properties}}', [
            'id' => $this->primaryKey(),
            'obj_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'value' => $this->string(50)->notNull(),
        ]);
        $this->addForeignKey('fk_obj_properties_type', '{{%obj_properties}}', 'type_id', '{{%obj_type_properties}}', 'id');
        $this->addForeignKey('fk_obj_properties_obj', '{{%obj_properties}}', 'obj_id', '{{%obj_list}}', 'id');


        $this->insert('{{%obj_properties}}', ['obj_id' => 1, 'type_id' => 1, 'value' => '100']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 1, 'type_id' => 2, 'value' => '999']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 1, 'type_id' => 3, 'value' => 'Libher']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 2, 'type_id' => 4, 'value' => '200']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 2, 'type_id' => 5, 'value' => 'true']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 3, 'type_id' => 6, 'value' => 'volvo']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 3, 'type_id' => 7, 'value' => '50']);

        $this->insert('{{%obj_properties}}', ['obj_id' => 4, 'type_id' => 1, 'value' => '800']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 4, 'type_id' => 2, 'value' => '1111']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 4, 'type_id' => 3, 'value' => 'Strela']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 5, 'type_id' => 4, 'value' => '300']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 5, 'type_id' => 5, 'value' => 'false']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 6, 'type_id' => 6, 'value' => 'mazda']);
        $this->insert('{{%obj_properties}}', ['obj_id' => 6, 'type_id' => 7, 'value' => '100']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_obj_list_type', '{{%obj_list}}');
        $this->dropForeignKey('fk_obj_type_properties', '{{%obj_type_properties}}');
        $this->dropForeignKey('fk_obj_properties_type', '{{%obj_properties}}');
        $this->dropForeignKey('fk_obj_properties_obj', '{{%obj_properties}}');

        $this->dropTable('{{%obj_type}}');
        $this->dropTable('{{%obj_type_properties}}');
        $this->dropTable('{{%obj_list}}');
        $this->dropTable('{{%obj_properties}}');
    }

}
