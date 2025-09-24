<?php

namespace olcaytaner\DependencyParser;

class ParserEvaluationScore
{
    private float $LAS = 0.0;

    private float $UAS = 0.0;
    private float $LS = 0.0;
    private int $wordCount = 0;

    /**
     * Another constructor of the parser evaluation score object.
     * @param float $LAS Label attachment score
     * @param float $UAS Unlabelled attachment score
     * @param float $LS Label score
     * @param int $wordCount Number of words evaluated
     */
    public function __construct(float $LAS = 0.0, float $UAS = 0.0, float $LS = 0.0, int $wordCount = 0)
    {
        $this->LAS = $LAS;
        $this->UAS = $UAS;
        $this->LS = $LS;
        $this->wordCount = $wordCount;
    }

    /**
     * Accessor for the LAS field
     * @return float Label attachment score
     */
    public function getLAS(): float
    {
        return $this->LAS;
    }

    /**
     * Accessor for the UAS field
     * @return float Unlabelled attachment score
     */
    public function getUAS(): float
    {
        return $this->UAS;
    }

    /**
     * Accessor for the LS field
     * @return float Label score
     */
    public function getLS(): float
    {
        return $this->LS;
    }

    /**
     * Accessor for the word count field
     * @return int Number of words evaluated
     */
    public function getWordCount(): int
    {
        return $this->wordCount;
    }

    /**
     * Adds a parser evaluation score to the current evaluation score.
     * @param ParserEvaluationScore $parserEvaluationScore Parser evaluation score to be added.
     */
    public function add(ParserEvaluationScore $parserEvaluationScore){
        $this->LAS = ($this->LAS * $this->wordCount + $parserEvaluationScore->LAS * $parserEvaluationScore->wordCount) / ($this->wordCount + $parserEvaluationScore->wordCount);
        $this->UAS = ($this->UAS * $this->wordCount + $parserEvaluationScore->UAS * $parserEvaluationScore->wordCount) / ($this->wordCount + $parserEvaluationScore->wordCount);
        $this->LS = ($this->LS * $this->wordCount + $parserEvaluationScore->LS * $parserEvaluationScore->wordCount) / ($this->wordCount + $parserEvaluationScore->wordCount);
        $this->wordCount += $parserEvaluationScore->wordCount;
    }

}