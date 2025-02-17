<?php

namespace App\Controllers\DSA;

class Stack
{
    private $stack = []; 

    // Push an element onto the stack
    public function push($item){
        array_push($this->stack, $item);
    }

    // Pop an element from the stack
    public function pop(){
        if (!$this->isEmpty()) {
            return array_pop($this->stack);
        }
        return null; // Return null if stack is empty
    }

    // Peek the top element without removing it
    public function peek(){
        return !$this->isEmpty() ? end($this->stack) : null;
    }

    // Check if the stack is empty
    public function isEmpty(){
        return empty($this->stack);
    }

    // Get stack size
    public function size(){
        return count($this->stack);
    }

    // Display the stack
    public function getStack(){
        return $this->stack;
    }
}
