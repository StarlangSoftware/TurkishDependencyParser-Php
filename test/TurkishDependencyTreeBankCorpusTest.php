<?php

use olcaytaner\DataStructure\CounterHashMap;
use olcaytaner\DependencyParser\Turkish\TurkishDependencyTreeBankCorpus;
use olcaytaner\DependencyParser\Turkish\TurkishDependencyTreeBankWord;

class TurkishDependencyTreeBankCorpusTest extends \PHPUnit\Framework\TestCase
{
    public function testDependencyCorpus(){
        $relationCounts = new CounterHashMap();
        $wordCount = 0;
        $corpus = new TurkishDependencyTreeBankCorpus("../metu-treebank.xml");
        for ($i = 0; $i < $corpus->sentenceCount(); $i++) {
            $sentence = $corpus->getSentence($i);
            $wordCount += $sentence->wordCount();
            for ($j = 0; $j < $sentence->wordCount(); $j++) {
                $word = $sentence->getWord($j);
                if ($word instanceof TurkishDependencyTreeBankWord && $word->getRelation() != null){
                    $relationCounts->put($word->getRelation()->__toString());
                }
            }
        }
        $this->assertEquals(53993, $wordCount);
        $this->assertEquals(11692, $relationCounts->count("MODIFIER"));
        $this->assertEquals(903, $relationCounts->count("INTENSIFIER"));
        $this->assertEquals(1142, $relationCounts->count("LOCATIVE.ADJUNCT"));
        $this->assertEquals(240, $relationCounts->count("VOCATIVE"));
        $this->assertEquals(7261, $relationCounts->count("SENTENCE"));
        $this->assertEquals(16, $relationCounts->count("EQU.ADJUNCT"));
        $this->assertEquals(159, $relationCounts->count("NEGATIVE.PARTICLE"));
        $this->assertEquals(4481, $relationCounts->count("SUBJECT"));
        $this->assertEquals(2476, $relationCounts->count("COORDINATION"));
        $this->assertEquals(2050, $relationCounts->count("CLASSIFIER"));
        $this->assertEquals(73, $relationCounts->count("COLLOCATION"));
        $this->assertEquals(1516, $relationCounts->count("POSSESSOR"));
        $this->assertEquals(523, $relationCounts->count("ABLATIVE.ADJUNCT"));
        $this->assertEquals(23, $relationCounts->count("FOCUS.PARTICLE"));
        $this->assertEquals(1952, $relationCounts->count("DETERMINER"));
        $this->assertEquals(1361, $relationCounts->count("DATIVE.ADJUNCT"));
        $this->assertEquals(202, $relationCounts->count("APPOSITION"));
        $this->assertEquals(289, $relationCounts->count("QUESTION.PARTICLE"));
        $this->assertEquals(597, $relationCounts->count("S.MODIFIER"));
        $this->assertEquals(10, $relationCounts->count("ETOL"));
        $this->assertEquals(8338, $relationCounts->count("OBJECT"));
        $this->assertEquals(271, $relationCounts->count("INSTRUMENTAL.ADJUNCT"));
        $this->assertEquals(85, $relationCounts->count("RELATIVIZER"));
    }
}