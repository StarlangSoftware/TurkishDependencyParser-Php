<?php

namespace olcaytaner\DependencyParser\Turkish;

use olcaytaner\DependencyParser\DependencyRelation;

class TurkishDependencyRelation extends DependencyRelation
{
    private int $toIG;
    private TurkishDependencyType $turkishDependencyType;

    static array $turkishDependencyTypes = ["VOCATIVE", "SUBJECT", "DATIVE.ADJUNCT", "OBJECT", "POSSESSOR",
        "MODIFIER", "S.MODIFIER", "ABLATIVE.ADJUNCT", "DETERMINER", "SENTENCE",
        "CLASSIFIER", "LOCATIVE.ADJUNCT", "COORDINATION", "QUESTION.PARTICLE", "INTENSIFIER",
        "INSTRUMENTAL.ADJUNCT", "RELATIVIZER", "NEGATIVE.PARTICLE", "ETOL", "COLLOCATION",
        "FOCUS.PARTICLE", "EQU.ADJUNCT", "APPOSITION"];

    static array $turkishDependencyTags = [TurkishDependencyType::VOCATIVE, TurkishDependencyType::SUBJECT, TurkishDependencyType::DATIVE_ADJUNCT, TurkishDependencyType::OBJECT, TurkishDependencyType::POSSESSOR,
        TurkishDependencyType::MODIFIER, TurkishDependencyType::S_MODIFIER, TurkishDependencyType::ABLATIVE_ADJUNCT, TurkishDependencyType::DETERMINER, TurkishDependencyType::SENTENCE,
        TurkishDependencyType::CLASSIFIER, TurkishDependencyType::LOCATIVE_ADJUNCT, TurkishDependencyType::COORDINATION, TurkishDependencyType::QUESTION_PARTICLE, TurkishDependencyType::INTENSIFIER,
        TurkishDependencyType::INSTRUMENTAL_ADJUNCT, TurkishDependencyType::RELATIVIZER, TurkishDependencyType::NEGATIVE_PARTICLE, TurkishDependencyType::ETOL, TurkishDependencyType::COLLOCATION,
        TurkishDependencyType::FOCUS_PARTICLE, TurkishDependencyType::EQU_ADJUNCT, TurkishDependencyType::APPOSITION];

    /**
     * Another constructor for TurkishDependencyRelation. Gets input toWord, toIG, and dependencyType as arguments and
     * calls the super class's constructor and sets the IG and dependency type.
     * @param int $toWord Index of the word in the sentence that dependency relation is related
     * @param int $toIG Index of the inflectional group the dependency relation is related
     * @param string $turkishDependencyType Type of the dependency relation in string form
     */
    public function __construct(int $toWord, int $toIG, string $turkishDependencyType){
        parent::__construct($toWord);
        $this->toIG = $toIG;
        $this->turkishDependencyType = self::getDependencyTag($turkishDependencyType);
    }

    /**
     * The getDependencyTag method takes an dependency tag as string and returns the {@link TurkishDependencyType}
     * form of it.
     *
     * @param string $tag  Type of the dependency tag in string form
     * @return TurkishDependencyType|null Type of the dependency in {@link TurkishDependencyType} form
     */
    public static function getDependencyTag(string $tag): ?TurkishDependencyType
    {
        for ($j = 0; $j < count(self::$turkishDependencyTypes); $j++) {
            if (self::$turkishDependencyTypes[$j] === strtoupper($tag)) {
                return self::$turkishDependencyTags[$j];
            }
        }
        return null;
    }

    /**
     * Accessor for the toIG attribute
     * @return int toIG attribute
     */
    public function toIG(): int
    {
        return $this->toIG;
    }

    /**
     * Accessor for the turkishDependencyType attribute
     * @return TurkishDependencyType turkishDependencyType attribute
     */
    public function getTurkishDependencyType(): TurkishDependencyType
    {
        return $this->turkishDependencyType;
    }

    public function __toString(): string
    {
        for ($j = 0; $j < count(self::$turkishDependencyTags); $j++) {
            if (self::$turkishDependencyTags[$j] === $this->turkishDependencyType) {
                return self::$turkishDependencyTypes[$j];
            }
        }
    }

}