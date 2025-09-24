<?php

namespace olcaytaner\DependencyParser\Universal;

use olcaytaner\Corpus\Corpus;
use olcaytaner\DependencyParser\ParserEvaluationScore;

class UniversalDependencyTreeBankCorpus extends Corpus
{
    private string $language;

    /**
     * Constructs a universal dependency corpus from an input file. Reads the sentences one by one and constructs a
     * universal dependency sentence from each line read.
     * @param string|null $fileName Input file name.
     */
    public function __construct(?string $fileName = null){
        parent::__construct();
        if (!is_null($fileName)) {
            $sentence = "";
            if (str_contains($fileName, "/")){
                $modified = mb_substr($fileName, mb_strrpos($fileName, "/") + 1);
            } else {
                $modified = $fileName;
            }
            $this->language = mb_substr($modified, 0, mb_strpos($modified, "_"));
            $fh = fopen($fileName, 'r');
            while ($line = fgets($fh)) {
                $line = trim($line);
                if (mb_strlen($line) == 0 && mb_strlen($sentence) != 0){
                    $this->addSentence(new UniversalDependencyTreeBankSentence($this->language, $sentence));
                    $sentence = "";
                } else {
                    $sentence .= $line . PHP_EOL;
                }
            }
        }
    }

    /**
     * Compares the corpus with the given corpus and returns a parser evaluation score for this comparison. The result
     * is calculated by summing up the parser evaluation scores of sentence by sentence comparisons.
     * @param UniversalDependencyTreeBankCorpus $corpus Universal dependency corpus to be compared.
     * @return ParserEvaluationScore A parser evaluation score object.
     */
    public function compareParses(UniversalDependencyTreeBankCorpus $corpus): ParserEvaluationScore{
        $score = new ParserEvaluationScore();
        for ($i = 0; $i < count($this->sentences); $i++) {
            $score->add(($this->sentences[$i])->compareParses($corpus->getSentence($i)));
        }
        return $score;
    }
}