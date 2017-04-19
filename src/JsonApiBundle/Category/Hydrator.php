<?php

namespace JsonApiBundle\Category;

use PageBundle\Entity\Article;
use PageBundle\Entity\Category;
use JsonApiBundle\Services\BaseHydrator;

class Hydrator extends BaseHydrator
{
    /**
     * @return array
     */
    public function getAttributes()
    {
        return [
            'name',
            'description',
        ];
    }

    /**
     * @return array
     */
    public function getRelations()
    {
        return [
            'articles',
        ];
    }

    /**
     * @return Category
     */
    protected function getNewObject()
    {
        return new Category();
    }

    /**
     * @return array
     */
    protected function getRelatedObjects()
    {
        return [
            'articles' => new Article()
        ];
    }
}
