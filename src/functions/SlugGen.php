<?php

namespace Wdd\Slug\src\functions;

use Wdd\Slug\Models\Slug;

class SlugGen {
    public function generator33(string $title)
    {
        $string = str_replace(' ','',$title);
        return substr($string,0,3).rand(100,999);
    }

    private function generator8()
    {
        return ''.rend(10000000,99999999);
    }

    public function createUnique(string $title,$model,$code)
    {
        $tries = 0;
        $slug = '';
        for (;;) {
            if ($code == 33) {
                $slug = $this->generator33($title);
            } elseif ($code == 8) {
                $slug = $this->generator8();
            }
            $checkExists = Slug::where('slug',$slug)->where('model',$model)->exists();
            if (!$checkExists) {
                break;
            }
            if ($tries == 10000) {
                throw new ErrorException("Can't Create Slug",408);
            }
            $tries++;
        }
        return $slug;
    }
}

