<?php

/*
 *   This file is part of Geekbot.
 *
 *   Geekbot is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   Geekbot is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with Geekbot.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Geekbot;

use Geekbot\Utils;

class Reactions {

    private $reactions;
    
    function __construct() {
        $reactions = json_decode(Utils::getFile("reactions.json"));
        if(isset($reactions)){
            $this->reactions = $reactions;
            echo("reactions loaded...\n\n");
        }
        else {
            print("please set some reactionstring in reactions.json");
            die();
        }
    }
    
    function getReaction($message) {
        if(isset($this->reactions->$message)) {
            $string = $this->reactions->$message;
            $author = "rune";
            $mention = "alex";
            if (str_contains($string, "{@author}")) {
                $string = str_replace('{@author}', $author, $string);
            }
            if (str_contains($string, "{@mention}")) {
                $string = str_replace('{@mention}', $mention, $string);
            }
            return $string;
        } else {
          return NULL;
        }
    }
}