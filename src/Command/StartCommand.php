<?php

namespace ChessServer\Command;

use Chess\PGN\Symbol;
use ChessServer\GameMode\AnalysisMode;
use ChessServer\GameMode\LoadFenMode;
use ChessServer\GameMode\PlayFriendMode;

class StartCommand extends AbstractCommand
{
    public function __construct()
    {
        $this->name = '/start';
        $this->description = 'Starts a new game.';
        $this->params = [
            // mandatory param
            'mode' => [
                AnalysisMode::NAME,
                LoadFenMode::NAME,
                PlayFriendMode::NAME,
            ],
            // 'Load FEN' mode
            // optional param
            'fen' => 'string',
            // PlayFriend mode
            // optional param
            'color' => [
                Symbol::WHITE,
                Symbol::BLACK,
            ],
            // optional param
            'min' => 'int',
        ];
    }

    public function validate(array $argv)
    {
        if (in_array($argv[1], $this->params['mode'])) {
            switch ($argv[1]) {
                case AnalysisMode::NAME:
                    return count($argv) - 1 === 1;
                case LoadFenMode::NAME:
                    return count($argv) - 1 === 2;
                case PlayFriendMode::NAME:
                    return count($argv) - 1 === 3;
                default:
                    // do nothing
                    break;
            }
        }

        return false;
    }
}
