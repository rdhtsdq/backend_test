<?php

class Game
{
    private $main_layout;
    private $layout1;
    private $layout2;
    private $layout3;
    private $layout4;
    private $layout5;
    private $layout6;
    private $initial_position;

    private $finish;
    private $message;

    public function __construct()
    {

        $this->layout1 = ["#", "#", "#", "#", "#", "#", "#", "#"];
        $this->layout2 = ["#", ".", ".", ".", ".", ".", ".", "#"];
        $this->layout3 = ["#", '.', '#', '#', '#', '.', '.', '#'];
        $this->layout4 = ['#', '.', '.', '.', '#', '.', '#', '#'];
        $this->layout5 = ['#', '.', '#', '.', '.', '.', '.', '#'];
        $this->layout6 = ['#', '#', '#', '#', '#', '#', '#', '#'];
        $this->main_layout = [
            $this->layout1,
            $this->layout2,
            $this->layout3,
            $this->layout4,
            $this->layout5,
            $this->layout6
        ];
        $this->initial_position = [4, 1];
        $this->finish = false;
        $this->randomizeTreasure();
    }

    public function startGame()
    {
        $this->main_layout[$this->initial_position[0]][$this->initial_position[1]] = "X";
        echo "Lets play game \n";
        echo "=============== \n";

        while ($this->finish == false) {
            echo "\n";
            $this->printLayout();
            if ($this->message) {
                echo $this->message . "\n";
            }
            $this->message = '';
            $this->input();
        }
    }

    private function randomizeTreasure()
    {
        $row = rand(1, count($this->main_layout) - 2);
        $col = rand(1, count($this->main_layout[$row]) - 2); // Random column within the clear path

        $this->main_layout[$row][$col] = '$';
    }


    private function printLayout()
    {
        foreach ($this->main_layout as $l) {
            $join = join($l);
            echo "$join \n";
        }

        echo "\n";
        echo "a: up, b: right, c:down, d: left";
        echo "\n\n";
    }

    private function input()
    {
        $validInput = false;

        while (!$validInput) {
            $input = trim(fgets(STDIN));

            if ($input === 'a' || $input === 'b' || $input === 'c' || $input === 'd') {
                $validInput = true;
                $this->changePosition($input);
            } else {
                echo "Invalid move! Use 'a' (up), 'b' (right), 'c' (down), or 'd' (left).\n";
            }
        }
    }

    private function changePosition($i)
    {
        $temporaryPosition = $this->initial_position;
        list($row, $col) = $temporaryPosition;

        if ($i === 'a') {
            $newRow = $row - 1;
            if ($this->isValidMove($newRow, $col)) {
                $this->makeMove($row, $col, $newRow, $col);
                $this->finish = $this->isEnd($newRow, $col);
            }
        } elseif ($i === 'b') {
            $newCol = $col + 1;
            if ($this->isValidMove($row, $newCol)) {
                $this->makeMove($row, $col, $row, $newCol);
                $this->finish = $this->isEnd($row, $newCol);
            }
        } elseif ($i === 'c') {
            $newRow = $row + 1;
            if ($this->isValidMove($newRow, $col)) {
                $this->makeMove($row, $col, $newRow, $col);
                $this->finish = $this->isEnd($newRow, $col);
            }
        } elseif ($i === 'd') {
            $newCol = $col - 1;
            if ($this->isValidMove($row, $newCol)) {
                $this->makeMove($row, $col, $row, $newCol);
                $this->finish = $this->isEnd($row, $newCol);
            }
        }
    }

    private function isValidMove($row, $col)
    {
        return isset($this->main_layout[$row][$col]) && $this->main_layout[$row][$col] !== '#';
    }

    private function isEnd($row, $col)
    {
        if ($this->main_layout[$row][$col] === '$') {
            return true;
        }
    }

    private function makeMove($currentRow, $currentCol, $newRow, $newCol)
    {
        $this->main_layout[$currentRow][$currentCol] = '.';
        $this->main_layout[$newRow][$newCol] = 'X';
        $this->initial_position = [$newRow, $newCol];

        if ($this->main_layout[$newRow][$newCol] === '.') {
            $this->message = "You found the item! Congratulations!";
            $this->finish = true;
        }
    }
}

$game = new Game();

$game->startGame();
