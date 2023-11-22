<?php

use yii\db\Migration;

class m231122_180147_add_foreign_keys extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-company-mother_id',
            'company',
            'mother_id',
            'company',
            'id'
        );

        $this->addForeignKey(
            'fk-episode-serie_id',
            'episode',
            'serie_id',
            'serie',
            'id'
        );

        $this->addForeignKey(
            'fk-film-collection_id',
            'film',
            'collection_id',
            'collection',
            'id'
        );

        $this->addForeignKey(
            'fk-film_company-film_id',
            'film_company',
            'film_id',
            'film',
            'id'
        );

        $this->addForeignKey(
            'fk-film_company-company_id',
            'film_company',
            'company_id',
            'company',
            'id'
        );

        $this->addForeignKey(
            'fk-film_genre-film_id',
            'film_genre',
            'film_id',
            'film',
            'id'
        );

        $this->addForeignKey(
            'fk-film_genre-genre_id',
            'film_genre',
            'genre_id',
            'genre',
            'id'
        );

        $this->addForeignKey(
            'fk-serie-stream_id',
            'serie',
            'stream_id',
            'stream',
            'id'
        );

        $this->addForeignKey(
            'fk-serie_company-serie_id',
            'serie_company',
            'serie_id',
            'serie',
            'id'
        );

        $this->addForeignKey(
            'fk-serie_company-company_id',
            'serie_company',
            'company_id',
            'company',
            'id'
        );

        $this->addForeignKey(
            'fk-serie_genre-serie_id',
            'serie_genre',
            'serie_id',
            'serie',
            'id'
        );

        $this->addForeignKey(
            'fk-serie_genre-genre_id',
            'serie_genre',
            'genre_id',
            'genre',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-company-mother_id', 'company');
        $this->dropForeignKey('fk-episode-serie_id', 'episode');
        $this->dropForeignKey('fk-film-collection_id', 'film');
        $this->dropForeignKey('fk-film_company-film_id', 'film_company');
        $this->dropForeignKey('fk-film_company-company_id', 'film_company');
        $this->dropForeignKey('fk-film_genre-genre_id', 'film_genre');
        $this->dropForeignKey('fk-film_genre-film_id', 'film_genre');
        $this->dropForeignKey('fk-serie-stream_id', 'serie');
        $this->dropForeignKey('fk-serie_company-serie_id', 'serie_company');
        $this->dropForeignKey('fk-serie_company-company_id', 'serie_company');
        $this->dropForeignKey('fk-serie_genre-genre_id', 'serie_genre');
        $this->dropForeignKey('fk-serie_genre-serie_id', 'serie_genre');
    }
}
