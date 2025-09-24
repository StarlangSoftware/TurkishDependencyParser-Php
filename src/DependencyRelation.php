<?php

namespace olcaytaner\DependencyParser;

class DependencyRelation
{
    protected int $toWord;

    /**
     * Constructor for a {@link DependencyRelation}. Takes toWord as a parameter and sets the corresponding attribute.
     * @param int $toWord Index of the word in the sentence that dependency relation is related
     */
    public function __construct(int $toWord){
        $this->toWord = $toWord;
    }

    /**
     * Accessor for toWord attribute
     * @return int toWord attribute value
     */
    public function to(): int{
        return $this->toWord;
    }
}