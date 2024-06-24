<?php

namespace App\Enums;

enum GameType: string
{
    case MakePlurals = 'Make Plurals';
    case MakePresentTense = 'Make Present Tense';
    case HowDoTheyFeel = 'How Do They Feel?';

    public function getDescription(): string
    {
        match ($this) {
            self::MakePlurals => 'Make the following words plural.',
            self::MakePresentTense => 'Make the following words present tense.',
            self::HowDoTheyFeel => 'How do they feel?',
        };
    }

    public function getExplanation(): string
    {
        match ($this) {
            self::MakePlurals => 'To make a word plural, you usually add an "s" to the end of the word.',
            self::MakePresentTense => 'To make a word present tense, you usually add an "s" to the end of the word.',
            self::HowDoTheyFeel => 'To describe how someone feels, you can use the following words.',
        };
    }

    public function getExample(): string
    {
        match ($this) {
            self::MakePlurals => 'dog -> dogs',
            self::MakePresentTense => 'run -> runs',
            self::HowDoTheyFeel => 'happy, sad, angry, tired, excited',
        };
    }
}
