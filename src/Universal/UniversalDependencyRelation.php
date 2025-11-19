<?php

namespace olcaytaner\DependencyParser\Universal;

use olcaytaner\DependencyParser\DependencyRelation;
use olcaytaner\DependencyParser\ParserEvaluationScore;

class UniversalDependencyRelation extends DependencyRelation
{
    private ?UniversalDependencyType $universalDependencyType;

    static array $universalDependencyTypes = ["ACL", "ADVCL",
        "ADVMOD", "AMOD", "APPOS", "AUX", "CASE",
        "CC", "CCOMP", "CLF", "COMPOUND", "CONJ",
        "COP", "CSUBJ", "DEP", "DET", "DISCOURSE",
        "DISLOCATED", "EXPL", "FIXED", "FLAT",
        "GOESWITH", "IOBJ", "LIST", "MARK", "NMOD",
        "NSUBJ", "NUMMOD", "OBJ", "OBL", "ORPHAN",
        "PARATAXIS", "PUNCT", "REPARANDUM", "ROOT",
        "VOCATIVE", "XCOMP", "ACL:RELCL", "AUX:PASS",
        "CC:PRECONJ", "COMPOUND:PRT", "DET:PREDET", "FLAT:FOREIGN",
        "NSUBJ:PASS", "CSUBJ:PASS", "NMOD:NPMOD", "NMOD:POSS",
        "NMOD:TMOD", "ADVMOD:EMPH", "AUX:Q", "COMPOUND:LVC",
        "COMPOUND:REDUP", "CSUBJ:COP", "NMOD:COMP", "NMOD:PART",
        "NSUBJ:COP", "OBL:AGENT", "OBL:TMOD", "OBL:NPMOD", "NSUBJ:OUTER",
        "CSUBJ:OUTER", "ADVCL:RELCL", "OBL:UNMARKED"];

    static array $universalDependencyTags = [UniversalDependencyType::ACL, UniversalDependencyType::ADVCL,
        UniversalDependencyType::ADVMOD, UniversalDependencyType::AMOD, UniversalDependencyType::APPOS, UniversalDependencyType::AUX, UniversalDependencyType::CASE,
        UniversalDependencyType::CC, UniversalDependencyType::CCOMP, UniversalDependencyType::CLF, UniversalDependencyType::COMPOUND, UniversalDependencyType::CONJ,
        UniversalDependencyType::COP, UniversalDependencyType::CSUBJ, UniversalDependencyType::DEP, UniversalDependencyType::DET, UniversalDependencyType::DISCOURSE,
        UniversalDependencyType::DISLOCATED, UniversalDependencyType::EXPL, UniversalDependencyType::FIXED, UniversalDependencyType::FLAT,
        UniversalDependencyType::GOESWITH, UniversalDependencyType::IOBJ, UniversalDependencyType::LIST, UniversalDependencyType::MARK, UniversalDependencyType::NMOD,
        UniversalDependencyType::NSUBJ, UniversalDependencyType::NUMMOD, UniversalDependencyType::OBJ, UniversalDependencyType::OBL, UniversalDependencyType::ORPHAN,
        UniversalDependencyType::PARATAXIS, UniversalDependencyType::PUNCT, UniversalDependencyType::REPARANDUM, UniversalDependencyType::ROOT,
        UniversalDependencyType::VOCATIVE, UniversalDependencyType::XCOMP, UniversalDependencyType::ACL_RELCL, UniversalDependencyType::AUX_PASS,
        UniversalDependencyType::CC_PRECONJ, UniversalDependencyType::COMPOUND_PRT, UniversalDependencyType::DET_PREDET, UniversalDependencyType::FLAT_FOREIGN,
        UniversalDependencyType::NSUBJ_PASS, UniversalDependencyType::CSUBJ_PASS, UniversalDependencyType::NMOD_NPMOD, UniversalDependencyType::NMOD_POSS,
        UniversalDependencyType::NMOD_TMOD, UniversalDependencyType::ADVMOD_EMPH, UniversalDependencyType::AUX_Q, UniversalDependencyType::COMPOUND_LVC,
        UniversalDependencyType::COMPOUND_REDUP, UniversalDependencyType::CSUBJ_COP, UniversalDependencyType::NMOD_COMP, UniversalDependencyType::NMOD_PART,
        UniversalDependencyType::NSUBJ_COP, UniversalDependencyType::OBL_AGENT, UniversalDependencyType::OBL_TMOD, UniversalDependencyType::OBL_NPMOD,
        UniversalDependencyType::NSUBJ_OUTER, UniversalDependencyType::CSUBJ_OUTER, UniversalDependencyType::ADVCL_RELCL, UniversalDependencyType::OBL_UNMARKED];

    static array $universalDependencyPosTypes = ["ADJ", "ADV", "INTJ", "NOUN", "PROPN", "VERB", "ADP", "AUX", "CCONJ",
        "DET", "NUM", "PART", "PRON", "SCONJ", "PUNCT", "SYM", "X"];

    static array $universalDependencyPosTags = [UniversalDependencyPosType::ADJ, UniversalDependencyPosType::ADV, UniversalDependencyPosType::INTJ, UniversalDependencyPosType::NOUN, UniversalDependencyPosType::PROPN,
        UniversalDependencyPosType::VERB, UniversalDependencyPosType::ADP, UniversalDependencyPosType::AUX, UniversalDependencyPosType::CCONJ, UniversalDependencyPosType::DET, UniversalDependencyPosType::NUM, UniversalDependencyPosType::PART,
        UniversalDependencyPosType::PRON, UniversalDependencyPosType::SCONJ, UniversalDependencyPosType::PUNCT, UniversalDependencyPosType::SYM, UniversalDependencyPosType::X];

    /**
     * Constructor for UniversalDependencyRelation. Gets input toWord and dependencyType as arguments and
     * calls the super class's constructor and sets the dependency type.
     * @param int $toWord Index of the word in the sentence that dependency relation is related
     * @param string $dependencyType Type of the dependency relation in string form
     */
    public function __construct(int $toWord, string $dependencyType){
        parent::__construct($toWord);
        $this->universalDependencyType = self::getDependencyTag($dependencyType);
    }

    /**
     * The getDependencyTag method takes an dependency tag as string and returns the {@link UniversalDependencyType}
     * form of it.
     *
     * @param string $tag  Type of the dependency tag in string form
     * @return UniversalDependencyType|null Type of the dependency in {@link UniversalDependencyType} form
     */
    public static function getDependencyTag(string $tag): ?UniversalDependencyType
    {
        for ($j = 0; $j < count(self::$universalDependencyTypes); $j++) {
            if (self::$universalDependencyTypes[$j] === strtoupper($tag)) {
                return self::$universalDependencyTags[$j];
            }
        }
        return null;
    }

    /**
     * The getDependencyPosType method takes a dependency pos type as string and returns the {@link UniversalDependencyPosType}
     * form of it.
     * @param string $tag Dependency pos type in string form
     * @return UniversalDependencyPosType|null Dependency pos type for a given dependency pos string
     */
    public static function getDependencyPosType(string $tag): ?UniversalDependencyPosType
    {
        for ($j = 0; $j < count(self::$universalDependencyPosTypes); $j++) {
            if (self::$universalDependencyPosTypes[$j] === strtoupper($tag)) {
                return self::$universalDependencyPosTags[$j];
            }
        }
        return null;
    }

    /**
     * Compares the relation with the given universal dependency relation and returns a parser evaluation score for this
     * comparison. If toWord fields are equal for both relation UAS is 1, otherwise it is 0. If both toWord and
     * dependency types are the same, LAS is 1, otherwise it is 0. If only dependency types of both relations are
     * the same, LS is 1, otherwise it is 0.
     * @param UniversalDependencyRelation $relation Universal dependency relation to be compared.
     * @return ParserEvaluationScore A parser evaluation score object with (i) LAS = 1, if to and dependency types are same; LAS = 0,
     * otherwise, (ii) UAS = 1, if to is the same; UAS = 0, otherwise, (iii) LS = 1, if dependency types are the same;
     * LS = 0, otherwise.
     */
    public function compareRelations(UniversalDependencyRelation $relation): ParserEvaluationScore
    {
        $LS = 0.0;
        $LAS = 0.0;
        $UAS = 0.0;
        if ($this->universalDependencyType == $relation->universalDependencyType) {
            $LS = 1.0;
            if ($this->toWord == $relation->toWord) {
                $LAS = 1.0;
            }
        }
        if ($this->toWord == $relation->toWord) {
            $UAS = 1.0;
        }
        return new ParserEvaluationScore($LAS, $UAS, $LS, 1);
    }

    public function __toString(): string
    {
        for ($j = 0; $j < count(self::$universalDependencyTags); $j++) {
            if (self::$universalDependencyTags[$j] === $this->universalDependencyType) {
                return self::$universalDependencyTypes[$j];
            }
        }
    }

}