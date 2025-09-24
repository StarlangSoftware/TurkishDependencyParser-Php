<?php

namespace olcaytaner\DependencyParser\Universal;

use olcaytaner\Corpus\Sentence;
use olcaytaner\DependencyParser\ParserEvaluationScore;

class UniversalDependencyTreeBankSentence extends Sentence
{
    private array $comments = [];
    private array $splits = [];

    /**
     * Constructor for the UniversalDependencyTreeBankSentence.  Get a line as input and splits the line wrt tab
     * character. The number of items should be 10. The items are id, surfaceForm, lemma, upos, xpos, feature list,
     * head word index, dependency type, external dependencies and miscellaneous things for one word.
     * @param string|null $language Language name. Currently, 'en' and 'tr' languages are supported.
     * @param string|null $sentence Sentence string to be processed.
     */
    public function __construct(?string $language, ?string $sentence){
        parent::__construct();
        if ($language !== null){
            $lines = explode("\n", $sentence);
            foreach ($lines as $line){
                if ($line == ""){
                    continue;
                }
                if (str_starts_with($line, "#")){
                    $this->addComment(trim($line));
                } else {
                    $items = explode("\t", $line);
                    if (count($items) == 10){
                        $id = $items[0];
                        if (preg_match("/^\\d+$/", $id) === 1){
                            $surfaceForm = $items[1];
                            $lemma = $items[2];
                            $upos = UniversalDependencyRelation::getDependencyPosType($items[3]);
                            if ($upos === null){
                                continue;
                            }
                            $xpos = $items[4];
                            $features = new UniversalDependencyTreeBankFeatures($language, $items[5]);
                            if ($items[6] !== "_"){
                                $to = (int) $items[6];
                                $dependencyType = strtoupper($items[7]);
                                $relation = new UniversalDependencyRelation($to, $dependencyType);
                            } else {
                                $relation = null;
                            }
                            $deps = $items[8];
                            $misc = $items[9];
                            $word = new UniversalDependencyTreeBankWord((int) $id, $surfaceForm, $lemma, $upos, $xpos, $features, $relation, $deps, $misc);
                            $this->addWord($word);
                        } else {
                            if (preg_match("/^\\d+-\\d+$/", $id) === 1){
                                $this->splits[] = $id;
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Adds a comment string to comments array list.
     * @param string $comment Comment to be added.
     */
    public function addComment(string $comment): void
    {
        $this->comments[] = $comment;
    }

    /**
     * Returns number of splits in the sentence
     * @return int Number of splits in the sentence
     */
    public function splitSize(): int{
        return count($this->splits);
    }

    /**
     * Returns the split at position index
     * @param int $index Position
     * @return string The split at position index
     */
    public function getSplit(int $index): string{
        return $this->splits[$index];
    }

    /**
     * Compares the sentence with the given sentence and returns a parser evaluation score for this comparison. The result
     * is calculated by summing up the parser evaluation scores of word by word dpendency relation comparisons.
     * @param UniversalDependencyTreeBankSentence $sentence Universal dependency sentence to be compared.
     * @return ParserEvaluationScore A parser evaluation score object.
     */
    public function compareParses(UniversalDependencyTreeBankSentence $sentence): ParserEvaluationScore{
        $score = new ParserEvaluationScore();
        for ($i = 0; $i < count($this->words); $i++){
            $relation1 = $this->words[$i]->getRelation();
            $relation2 = $sentence->getWord($i)->getRelation();
            if ($relation1 !== null && $relation2 !== null){
                $score->add($relation1->compareRelations($relation2));
            }
        }
        return $score;
    }
}