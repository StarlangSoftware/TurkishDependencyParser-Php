<?php

namespace olcaytaner\DependencyParser\Stanford;

enum StanfordDependencyType
{
    case ACOMP;
    case ADVCL;
    case ADVMOD;
    case AGENT;
    case AMOD;
    case APPOS;
    case AUX;
    case AUXPASS;
    case CC;
    case CCOMP;
    case CONJ;
    case COP;
    case CSUBJ;
    case CSUBJPASS;
    case DEP;
    case DET;
    case DISCOURSE;
    case DOBJ;
    case EXPL;
    case GOESWITH;
    case IOBJ;
    case MARK;
    case MWE;
    case NEG;
    case NN;
    case NPADVMOD;
    case NSUBJ;
    case NSUBJPASS;
    case NUM;
    case NUMBER;
    case PARATAXIS;
    case PCOMP;
    case POBJ;
    case POSS;
    case POSSESSIVE;
    case PRECONJ;
    case PREDET;
    case PREP;
    case PREPC;
    case PRT;
    case PUNCT;
    case QUANTMOD;
    case RCMOD;
    case REF;
    case ROOT;
    case TMOD;
    case VMOD;
    case XCOMP;
    case XSUBJ;
}