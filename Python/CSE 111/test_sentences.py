from sentences import get_determiner, get_noun, get_verb, get_preposition, get_prepositional_phrase
import pytest


def test_get_determiner():

    single_determiners = ["the", "one","a"]
    for _ in range(4):
        determiner = get_determiner(1)

        assert determiner in single_determiners

    plural_determiners = ["some", "many","two"]
    for _ in range(4):
        determiner = get_determiner(2)

        assert determiner in plural_determiners

def test_get_noun():

    single_nouns = ["adult","bird","boy","car","cat","child","dog",
        "girl", "man", "woman"]
    for _ in range(4):
        noun = get_noun(1)

        assert noun in single_nouns

    plural_nouns = ["adults", "birds", "boys", "cars", "cats","children",
        "dogs", "girls", "men", "women"]
    for _ in range(4):
        noun = get_noun(2)

        assert noun in plural_nouns

def test_get_verb():

    past_verbs = ["drank", "ate", "grew", "laughed", "thought",
        "ran", "slept", "talked", "walked", "wrote"]
    for _ in range(4):
        verb = get_verb (1 or 2,"past")

        assert verb in past_verbs

    future_verbs = [ "will drink", "will eat", "will grow", "will laugh",
        "will think", "will run", "will sleep", "will talk",
        "will walk", "will write"]
    for _ in range(4):
        verb = get_verb (1 or 2,"future")

        assert verb in future_verbs

    present_single_verbs = ["drinks", "eats", "grows", "laughs", "thinks",
        "runs", "sleeps", "talks", "walks", "writes"]
    for _ in range(4):
        verb = get_verb (1,"present")

        assert verb in present_single_verbs

    present_plural_verbs = ["drink", "eat", "grow", "laugh", "think",
        "run", "sleep", "talk", "walk", "write"]
    for _ in range(4):
        verb = get_verb (2,"present")

        assert verb in present_plural_verbs

def test_get_preposition():

    prepositions = ["about", "above", "across", "after", "along",
        "around", "at", "before", "behind", "below",
        "beyond", "by", "despite", "except", "for",
        "from", "in", "into", "near", "of",
        "off", "on", "onto", "out", "over",
        "past", "to", "under", "with", "without"]
    for _ in range(4):
        preposition = get_preposition()

        assert preposition in prepositions

def test_get_prepositional_phrase():
    
    single_prepositional_phrases = (f"{get_preposition()} {get_determiner(1)} {get_noun(1)}.")
    for _ in range (4):
        word_list = single_prepositional_phrases.split()
        number_of_words = len(word_list)

        assert number_of_words == 3

    plural_prepositional_phrases = (f"{get_preposition()} {get_determiner(2)} {get_noun(2)}.")
    for _ in range (4):
        word_list = plural_prepositional_phrases.split()
        number_of_words = len(word_list)

        assert number_of_words == 3



pytest.main(["-v", "--tb=line", "-rN", "test_sentences.py"])