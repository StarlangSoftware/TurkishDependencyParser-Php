<?php

namespace olcaytaner\DependencyParser\Turkish;

use olcaytaner\Dictionary\Dictionary\Word;
use olcaytaner\MorphologicalAnalysis\MorphologicalAnalysis\MorphologicalParse;
use olcaytaner\XmlParser\XmlElement;

class TurkishDependencyTreeBankWord extends Word
{
    private MorphologicalParse $parse;
    private array $originalParses = [];
    private ?TurkishDependencyRelation $relation = null;

    /**
     * Given the parsed xml node which contains information about a word and related attributes including the
     * dependencies, the method constructs a {@link TurkishDependencyTreeBankWord} from it.
     * @param XmlElement $wordNode Xml parsed node containing information about a word.
     */
    public function __construct(XmlElement $wordNode){
        parent::__construct("");
        $toWord = 0;
        $toIG = 0;
        if ($wordNode->hasAttributes()) {
            $this->name = $wordNode->getPcData();
            if ($wordNode->getAttributeValue("IG") != ""){
                $IG = $wordNode->getAttributeValue("IG");
                $this->parse = new MorphologicalParse($this->splitIntoInflectionalGroups($IG));
            }
            if ($wordNode->getAttributeValue("REL") != ""){
                $relationName = $wordNode->getAttributeValue("REL");
                if ($relationName != "[,( )]"){
                    $relationParts = preg_split("/[,\[\]()]/", $relationName);
                    $index = 0;
                    for ($i = 0; $i < count($relationParts); $i++) {
                        if ($relationParts[$i] != ""){
                            $index++;
                            switch ($index) {
                                case 1:
                                    $toWord = (int) $relationParts[$i];
                                    break;
                                case 2:
                                    $toIG = (int) $relationParts[$i];
                                    break;
                                case 3:
                                    $dependencyType = $relationParts[$i];
                                    $this->relation = new TurkishDependencyRelation($toWord - 1, $toIG - 1, $dependencyType);
                                    break;
                            }
                        }
                    }
                }
            }
            for ($i = 1; $i <= 9; $i++) {
                if ($wordNode->getAttributeValue("ORG_IG" . $i) != ""){
                    $IG = $wordNode->getAttributeValue("ORG_IG" . $i);
                    $this->originalParses[] = new MorphologicalParse($this->splitIntoInflectionalGroups($IG));
                }
            }
        }
    }

    /**
     * Given the morphological parse of a word, this method splits it into inflectional groups.
     * @param string $IG Morphological parse of the word in string form.
     * @return array An array of inflectional groups stored as strings.
     */
    private function splitIntoInflectionalGroups(string $IG): array{
        $inflectionalGroups = [];
        str_replace("(+Punc", "@", $IG);
        str_replace(")+Punc", "$", $IG);
        $iGs = preg_split("/[\[\]()]/", $IG);
        for ($i = 0; $i < count($iGs); $i++) {
            str_replace("@", "(+Punc", $iGs[$i]);
            str_replace("$", ")+Punc", $iGs[$i]);
            if (mb_strlen($iGs[$i]) != 0) {
                $inflectionalGroups[] = $iGs[$i];
            }
        }
        return $inflectionalGroups;
    }

    /**
     * Accessor for the parse attribute
     * @return MorphologicalParse Parse attribute
     */
    public function getParse(): MorphologicalParse {
        return $this->parse;
    }

    /**
     * Accessor for a specific parse.
     * @param int $index Index of the word.
     * @return MorphologicalParse|null Parse of the index'th word
     */
    public function getOriginalParse(int $index): ?MorphologicalParse {
        if ($index < count($this->originalParses)) {
            return $this->originalParses[$index];
        } else {
            return null;
        }
    }

    /**
     * Number of words in this item.
     * @return int Number of words in this item.
     */
    public function size(): int{
        return count($this->originalParses);
    }

    /**
     * Accessor for the relation attribute.
     * @return TurkishDependencyRelation|null relation attribute.
     */
    public function getRelation(): ?TurkishDependencyRelation {
        return $this->relation;
    }
}