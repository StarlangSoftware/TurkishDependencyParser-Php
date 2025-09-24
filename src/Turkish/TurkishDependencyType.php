<?php

namespace olcaytaner\DependencyParser\Turkish;

enum TurkishDependencyType
{
    case VOCATIVE;
    case SUBJECT;
    case DATIVE_ADJUNCT;
    case OBJECT;
    case POSSESSOR;
    case MODIFIER;
    case S_MODIFIER;
    case ABLATIVE_ADJUNCT;
    case DETERMINER;
    case SENTENCE;
    case CLASSIFIER;
    case LOCATIVE_ADJUNCT;
    case COORDINATION;
    case QUESTION_PARTICLE;
    case INTENSIFIER;
    case INSTRUMENTAL_ADJUNCT;
    case RELATIVIZER;
    case NEGATIVE_PARTICLE;
    case ETOL;
    case COLLOCATION;
    case FOCUS_PARTICLE;
    case EQU_ADJUNCT;
    case APPOSITION;
}