<?php

namespace olcaytaner\DependencyParser\Stanford;

use olcaytaner\DependencyParser\DependencyRelation;

class StanfordDependencyRelation extends DependencyRelation
{
    private StanfordDependencyType $stanfordDependencyType;

    static array $stanfordDependencyTypes = ["acomp", "advcl", "advmod", "agent", "amod", "appos", "aux",
        "auxpass", "cc", "ccomp", "conj", "cop", "csubj", "csubjpass", "dep", "det", "discourse", "dobj", "expl", "goeswith",
        "iobj", "mark", "mwe", "neg", "nn", "npadvmod", "nsubj", "nsubjpass", "num", "number", "parataxis", "pcomp",
        "pobj", "poss", "possessive", "preconj", "predet", "prep", "prepc", "prt", "punct", "quantmod", "rcmod", "ref",
        "root", "tmod", "vmod", "xcomp", "xsubj"];

    static array $stanfordDependencyTags = [StanfordDependencyType::ACOMP, StanfordDependencyType::ADVCL,
        StanfordDependencyType::ADVMOD, StanfordDependencyType::AGENT, StanfordDependencyType::AMOD, StanfordDependencyType::APPOS, StanfordDependencyType::AUX,
        StanfordDependencyType::AUXPASS, StanfordDependencyType::CC, StanfordDependencyType::CCOMP, StanfordDependencyType::CONJ, StanfordDependencyType::COP,
        StanfordDependencyType::CSUBJ, StanfordDependencyType::CSUBJPASS, StanfordDependencyType::DEP, StanfordDependencyType::DET, StanfordDependencyType::DISCOURSE,
        StanfordDependencyType::DOBJ, StanfordDependencyType::EXPL, StanfordDependencyType::GOESWITH, StanfordDependencyType::IOBJ, StanfordDependencyType::MARK,
        StanfordDependencyType::MWE, StanfordDependencyType::NEG, StanfordDependencyType::NN, StanfordDependencyType::NPADVMOD, StanfordDependencyType::NSUBJ,
        StanfordDependencyType::NSUBJPASS, StanfordDependencyType::NUM, StanfordDependencyType::NUMBER, StanfordDependencyType::PARATAXIS, StanfordDependencyType::PCOMP,
        StanfordDependencyType::POBJ, StanfordDependencyType::POSS, StanfordDependencyType::POSSESSIVE, StanfordDependencyType::PRECONJ, StanfordDependencyType::PREDET,
        StanfordDependencyType::PREP, StanfordDependencyType::PREPC, StanfordDependencyType::PRT, StanfordDependencyType::PUNCT, StanfordDependencyType::QUANTMOD,
        StanfordDependencyType::RCMOD, StanfordDependencyType::REF, StanfordDependencyType::ROOT, StanfordDependencyType::TMOD, StanfordDependencyType::VMOD,
        StanfordDependencyType::XCOMP, StanfordDependencyType::XSUBJ];

    public function __construct(int $toWord, string $stanfordDependencyType){
        parent::__construct($toWord);
        $this->stanfordDependencyType = self::getDependencyTag($stanfordDependencyType);
    }
    /**
     * The getDependencyTag method takes an dependency tag as string and returns the {@link StanfordDependencyType}
     * form of it.
     *
     * @param string $tag  Type of the dependency tag in string form
     * @return StanfordDependencyType|null Type of the dependency in {@link StanfordDependencyType} form
     */
    public static function getDependencyTag(string $tag): ?StanfordDependencyType
    {
        for ($j = 0; $j < count(self::$stanfordDependencyTypes); $j++) {
            if (self::$stanfordDependencyTypes[$j] === strtolower($tag)) {
                return self::$stanfordDependencyTags[$j];
            }
        }
        return null;
    }

    public function __toString(): string
    {
        for ($j = 0; $j < count(self::$stanfordDependencyTags); $j++) {
            if (self::$stanfordDependencyTags[$j] === $this->stanfordDependencyType) {
                return self::$stanfordDependencyTypes[$j];
            }
        }
    }

}