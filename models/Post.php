<?php

namespace app\models;

use Yii;

class Post extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_PUBLISHED = 'published';
    const STATUS_REJECTED = 'rejected';

    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return [
            // Menghapus spasi di awal dan akhir input.
            [['title', 'content', 'rejection_reason'], 'trim'],

            // Judul dan isi wajib diisi.
            [['title', 'content'], 'required'],

            // Validasi panjang judul.
            [['title'], 'string', 'max' => 255],

            // Validasi isi artikel dari CKEditor.
            [['content'], 'validateContent'],

            // Validasi tipe data.
            [['rejection_reason'], 'string'],

            // Validasi tanggal.
            [['date', 'reviewed_at'], 'safe'],

            // Validasi username dan reviewer.
            [['username', 'reviewed_by'], 'string', 'max' => 45],

            // Validasi status artikel.
            [['status'], 'in', 'range' => [
                self::STATUS_DRAFT,
                self::STATUS_PENDING,
                self::STATUS_PUBLISHED,
                self::STATUS_REJECTED,
            ]],

            [['status'], 'default', 'value' => self::STATUS_DRAFT],

            // Validasi username harus terdaftar.
            [
                ['username'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Account::className(),
                'targetAttribute' => ['username' => 'username']
            ],
        ];
    }

    /**
     * Memastikan isi CKEditor bukan hanya spasi atau HTML kosong.
     */
    public function validateContent($attribute, $params)
    {
        $content = $this->$attribute;

        // Jika konten kosong.
        if ($content === null || trim($content) === '') {
            $this->addError(
                $attribute,
                'Isi Artikel tidak boleh kosong.'
            );
            return;
        }

        // Decode HTML entity.
        $content = html_entity_decode(
            $content,
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );

        // Hapus tag HTML.
        $plainText = strip_tags($content);

        // Decode entity yang mungkin tersisa.
        $plainText = html_entity_decode(
            $plainText,
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );

        // Hilangkan spasi, tab, baris baru, dan karakter kosong.
        $plainText = preg_replace(
            '/[\s\x{00A0}\x{200B}\x{FEFF}]+/u',
            '',
            $plainText
        );

        // Tolak jika tidak ada teks yang tersisa.
        if ($plainText === '') {
            $this->addError(
                $attribute,
                'Isi Artikel tidak boleh kosong.'
            );
        }
    }

    public function attributeLabels()
    {
        return [
            'idpost' => 'ID',
            'title' => 'Judul Artikel',
            'content' => 'Isi Artikel',
            'date' => 'Tanggal',
            'username' => 'Penulis',
            'status' => 'Status',
            'rejection_reason' => 'Alasan Penolakan',
            'reviewed_by' => 'Direview Oleh',
            'reviewed_at' => 'Tanggal Review',
        ];
    }

    public function getUsername0()
    {
        return $this->hasOne(Account::className(), [
            'username' => 'username'
        ]);
    }

    public static function getStatusOptions()
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PENDING => 'Menunggu Review',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_REJECTED => 'Ditolak',
        ];
    }

    public function getStatusLabel()
    {
        $options = self::getStatusOptions();

        return isset($options[$this->status])
            ? $options[$this->status]
            : $this->status;
    }
}
