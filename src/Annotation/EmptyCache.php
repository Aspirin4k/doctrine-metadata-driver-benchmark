<?php

namespace App\Annotation;

use Doctrine\Common\Cache\Cache;

class EmptyCache implements Cache
{
    public function fetch($id)
    {
        return null;
    }

    public function contains($id)
    {
        return false;
    }

    public function save($id, $data, $lifeTime = 0)
    {
        return true;
    }

    public function delete($id)
    {
        return true;
    }

    public function getStats()
    {
        return [];
    }
}
