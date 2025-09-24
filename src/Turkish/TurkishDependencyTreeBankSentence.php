<?php

namespace olcaytaner\DependencyParser\Turkish;

use olcaytaner\Corpus\Sentence;
use olcaytaner\XmlParser\XmlElement;

class TurkishDependencyTreeBankSentence extends Sentence
{
    /**
     * Given the parsed xml node which contains information about a sentence, the method constructs a
     * {@link TurkishDependencyTreeBankSentence} from it.
     * @param XmlElement $sentenceNode Xml parsed node containing information about a sentence.
     */
    public function __construct(XmlElement $sentenceNode)
    {
        parent::__construct();
        $wordNode = $sentenceNode->getFirstChild();
        while ($wordNode !== null) {
            $word = new TurkishDependencyTreeBankWord($wordNode);
            $this->words[] = $word;
            $wordNode = $wordNode->getNextSibling();
        }
    }

    /**
     * Calculates the maximum of all word to related word distances, where the distances are calculated in terms of
     * index differences.
     * @return int Maximum of all word to related word distances.
     */
    public function maxDependencyLength(): int{
        $max = 0;
        for ($i = 0; $i < count($this->words); $i++) {
            $word = $this->words[$i];
            if ($word instanceof TurkishDependencyTreeBankWord && $word->getRelation() !== null && $word->getRelation()->to() - $i > $max) {
                $max = $word->getRelation()->to() - $i;
            }
        }
        return $max;
    }
}