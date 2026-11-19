<?php

use yii\db\Migration;

class m261106_110000_add_post_review_fields extends Migration
{
    public function up()
    {
        // Ambil struktur tabel terbaru
        $schema = $this->db->getTableSchema('post', true);

        // Tambahkan kolom hanya jika belum tersedia
        if (!isset($schema->columns['status'])) {
            $this->addColumn(
                '{{%post}}',
                'status',
                $this->string(20)->notNull()->defaultValue('draft')
            );
        }

        if (!isset($schema->columns['rejection_reason'])) {
            $this->addColumn(
                '{{%post}}',
                'rejection_reason',
                $this->text()->null()
            );
        }

        if (!isset($schema->columns['reviewed_by'])) {
            $this->addColumn(
                '{{%post}}',
                'reviewed_by',
                $this->string(45)->null()
            );
        }

        if (!isset($schema->columns['reviewed_at'])) {
            $this->addColumn(
                '{{%post}}',
                'reviewed_at',
                $this->dateTime()->null()
            );
        }

        // Pertahankan artikel lama sebagai published
        $this->update(
            '{{%post}}',
            ['status' => 'published']
        );

        echo "Post review fields successfully prepared.\n";
    }

    public function down()
    {
        $schema = $this->db->getTableSchema('post', true);

        $columns = [
            'reviewed_at',
            'reviewed_by',
            'rejection_reason',
            'status',
        ];

        foreach ($columns as $column) {
            if (isset($schema->columns[$column])) {
                $this->dropColumn('{{%post}}', $column);
            }
        }

        return true;
    }
}
